<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/18
 * Time: 17:27
 */

namespace App\Library;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SendSMS
{
    // 发送验证码
    public static function sendCode($phone, $code)
    {
        $time = time();
        $random = str_random(12);

        $signStr = sprintf("appkey=%s&random=%s&time=%s&mobile=%s",
            config('okcar.app_key'), $random, $time, $phone);

        $sign = Util::SHA256Hex($signStr);
        $content = [
            'ext' => '',
            'extend' => '',
            'params' => [
                $code,
                "1"
            ],
            'sig' => $sign,
            'sign' => config('okcar.sign_id'),
            'tel' => [
                'mobile' => $phone,
                'nationcode' => '86',
            ],
            'time' => $time,
            'tpl_id' => config('okcar.tpl_id'),

        ];

        $url = sprintf("https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=%s&random=%s",
            config('okcar.app_id'), $random);
        $client = new Client();
        $response = $client->request('POST', $url, ['body' => json_encode($content)]);
        $result = $response->getBody()->getContents();
        $retArr = json_decode($result, true);
        if (isset($retArr['result']) && $retArr['result'] == 0) {
            return true;
        } else {
            Log::error($result);
            return false;
        }


    }

}
