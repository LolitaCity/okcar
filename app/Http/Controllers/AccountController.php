<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/11
 * Time: 17:22
 */

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Library\HuanXin;
use App\Library\Util;
use App\Models\EnterpriseAuthentication;
use App\Models\RealnameAuthentication;
use App\Models\User;
use Illuminate\Http\Request;
use Cache;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    // 登录
    public function login(Request $request)
    {
        $time  = Util::getTime();
        $phone = $request->input('phone');          //手机号码
        $ticketId = $request->input('ticket_id');   //短信验证码
        $vcode = $request->input('vcode');          //用户输入的验证码
        $debug = $request->input('debug');

        if ($debug != 'true' && !($phone == config('okcar.no_check_phone') && $vcode == config('okcar.no_check_vcode'))) {
            $key = sprintf('%s_%s', $phone, $ticketId);
            $code = Cache::get($key);
            Cache::forget($key);

            if ($code !== $vcode || empty($code)) {
                throw new AppException('验证码错误', 1);
            }
        }

        $created = User::firstOrCreate(
            ['phone' => $phone],
            ['name' => $phone,
                'password' => Hash::make(''),
                'head_img' => '',
                'sale_brand' => '',
                'company_name' => '',
                'area' => 0]
        );
        $userInfo = $created->toArray();
        if (empty($userInfo['huanxin_id']) && empty($userInfo['huanxin_password'])) {
            $password = str_random(16);
            $id = HuanXin::register($phone, $password);
            User::where('phone', $phone)->update(['huanxin_id' => $phone, 'huanxin_password' => $password]);
        }

        $ret = Auth::attempt(['phone' => $phone, 'password' => ''], true);

        Log::info(Util::getTime() - $time);
        if ($ret == true) {
            $user = Auth::user();
            $userArr = $user->toArray();
            $userArr['token'] = $user->remember_token;
            $config = array_merge(['arealist' => config('arealist')], config('okcar_const'));
            return $this->json([
                'user' => $userArr,
                'config' => $config]);
        } else {
            throw new AppException('登录失败', 1);
        }
    }

    // 登出
    public function logout(Request $request)
    {
        $token = $request->input('token');
        User::where('remember_token', $token)->update(['remember_token' => null]);
        return $this->json();
    }

    //  个人详情页
    public function profile()
    {
        $user = Auth::user();
        return $this->json($user);
    }


    // 修改个人信息
    public function registerUpdate(Request $request)
    {
        $updated = $request->only([
            'name',
            'head_img',
            'sale_brand',
            'company_name',
            'area',
            'selfdesc']);

        $this->validate($updated, [
            'name' => 'max:100',
            'sale_brand' => 'max:100',
            'area' => 'numeric'
        ], [
            'name.max' => '用户名过长',
            'sale_brand.*' => '销售品牌格式不对',
            'area.*' => '所在区域信息不对'
        ]);

        $user = Auth::user();
        $ret = User::where('id', $user->id)->update($updated);
        if ($ret > 0) {
            return $this->json();
        }
        throw new AppException('修改失败', 1);
    }

    public function realnameAuthentication(Request $request)
    {
        $updated = $request->only([
            'realname',
            'idcard_num',
            'idcard_front_pic',
            'idcard_back_pic'
        ]);


        $this->validate($updated, [
            'realname' => 'required|max:10',
            'idcard_num' => 'required',
            'idcard_front_pic' => 'required',
            'idcard_back_pic' => 'required',
        ], [
            'realname.required' => '姓名必填',
            'realname.max' => '姓名过长',
            'idcard_front_pic.*' => '身份证正面必填',
            'idcard_back_pic.*' => '身份证反面必填',
        ]);

        $validate = Util::validateCard($updated['idcard_num']);
        if (!$validate) {
            throw new AppException('身份证格式不正确', 1);
        }
        $updated['status'] = AUTHENTICATION_ING;
        $user = Auth::user();
        $userId = $user->id;
        try {
            RealnameAuthentication::updateOrCreate(['user_id' => $userId], $updated);
            return $this->json();
        } catch (\Exception $e) {
            throw new AppException('认证信息提交失败', 1);
        }
    }


    public function enterpriseAuthentication(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $realnameAuth = RealnameAuthentication::where('user_id', $userId)->get()->toArray();
        if (empty($realnameAuth) || empty($realnameAuth[0]) || $realnameAuth[0]['status'] != AUTHENTICATION_SUC) {
            throw new AppException('请先进行实名认证', 1);
        }

        $updated = $request->only([
            'enterprise_name',
            'enterprise_type',
            'area',
            'pic1',
            'pic2',
            'pic3',
            'pic4',
            'pic5'
        ]);

        $this->validate($updated, [
            'enterprise_name' => 'required|max:200',
            'enterprise_type' => 'required',
            'area' => 'numeric',
            'pic1' => 'required',
            'pic2' => 'required',
            'pic3' => 'required',
        ], [
            'enterprise_name.required' => '公司名称必填',
            'enterprise_name.max' => '公司名称过长',
            'enterprise_type' => '公司类型必填',
            'pic1.*' => '照片1必填',
            'pic2.*' => '照片2必填',
            'pic3.*' => '照片3必填',
        ]);

        $updated['status'] = AUTHENTICATION_ING;

        try {
            EnterpriseAuthentication::updateOrCreate(['user_id' => $userId], $updated);
            return $this->json();
        } catch (\Exception $e) {
            throw new AppException('认证信息提交失败', 1);
        }
    }
}
