<?php

namespace App\Services;

use App\Exceptions\AppException;
use App\Library\SendSMS;
use Cache;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AccountService
{
    // 发送验证码
    public function sendCode($phone)
    {
        if (!preg_match('/^1[0-9]{10}$/', $phone)) {
            throw new AppException('手机号格式不正确', 1);
        }
        $key = $this->getKey($phone);
        if ($this->isMax($key)) {
            throw new AppException('超过最大上限', 1);
        }
        $vcode = strval(mt_rand(100000, 999999));

        $ticket = str_random(16);
        // todo: send sms
        SendSMS::sendcode($phone, $vcode);
        Cache::put(sprintf('%s_%s', $phone, $ticket), $vcode, config('okcar.vcode_expire_time'));
        Cache::increment($key, 1, 24 * 60 * 60);
        return $ticket;
    }

    private function isMax($key)
    {
        if (Cache::get($key, 0) >= config('okcar.max_vcode_per_day')) {
            return true;
        } else {
            return false;
        }
    }

    private function getKey($phone)
    {
        $today = date('Ymd');
        $key = sprintf('%s%s_%s', config('okcar.cache_key'), $today, $phone);
        return $key;
    }

    public function getUserList($keyword, $perPage = 20)
    {
        $data = User::where('phone', 'like', "%${keyword}%")->orWhere('name', 'like', "%${keyword}%")
            ->paginate($perPage);
        $list = [];
        forEach ($data->items() as $item) {
            $item = $item->makeVisible('updated_at')->toArray();
            $item = array_only($item, ['phone', 'name', 'head_img', 'sale_brand', 'company_name',
                'area_desc', 'updated_at', 'realname_authentication', 'realname_authentication_desc',
                'enterprise_authentication', 'enterprise_authentication_desc',
                'realname_authentication_reason', 'enterprise_authentication_reason']);
            $list[] = $item;
        }
        return [
            'items' => $list,
            'page' => $data->currentPage(),
            'totalPage' => $data->lastPage(),
            'pageSize' => $data->perPage()
        ];
    }

}
