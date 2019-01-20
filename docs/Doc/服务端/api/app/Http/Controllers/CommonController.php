<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/12
 * Time: 22:32
 */

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Library\COS;
use App\Models\Advice;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function uploadpic(Request $request)
    {
        $key = $request->input('key');
        $file = $request->file('image');
        if (empty($key)) {
            throw new AppException('key为必填字段', 1);
        }
        $extension = $file->extension();
        $path = $file->path();

        $filename = date('YmdHis') . mt_rand(1000, 9999);
        $cos = new COS();
        try {
            $url = $cos->upload($path, "$key/$filename.$extension");
        } catch (\Exception $e) {
            throw new AppException('上传失败', 1);
        }
        return $this->json(['url' => $url]);
    }


    public function sendcode(Request $request, AccountService $service)
    {
        $phone = $request->input('phone');
        $ticketId = $service->sendCode($phone);
        return $this->json(['ticket_id' => $ticketId]);
    }

    public function advice(Request $request)
    {
        $user = Auth::user();

        $data = $request->only(['content']);
        $this->validate($data, [
            'content' => 'required|max:1000'
        ], [
            'content.*' => '内容不超过1000字']);
        $data['user_id'] = $user->id;
        Advice::create($data);
        return $this->json();

    }

}
