<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/10/13
 * Time: 16:55
 */

namespace App\Library;

use App\Exceptions\AppException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HuanXin
{

    static $host = "https://a1-vip5.easemob.com";

    public static function getToken()
    {
        $url = self::getUrl() . "/token";
        $client = new Client();
        $clientId = env("HUANXIN_CLIENT_ID");
        $clientSecret = env("HUANXIN_CLIENT_SECRET");

        $body = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $client->request('POST', $url, ['body' => json_encode($body), 'http_errors' => false]);
        $result = $response->getBody()->getContents();
        $status = $response->getStatusCode();
        if ($status != 200) {
            Log::warn("huanxin:http_status: $status");
            throw new AppException("内部异常", 1);
        }
        $json = json_decode($result, true);
        return $json['access_token'];
    }

    public static function register($username, $password)
    {
        $token = self::getToken();
        $header = ["Authorization" => "Bearer $token"];

        $body = [
            'username' => $username,
            'password' => $password
        ];
        $url = self::getUrl() . "/users";
        $client = new Client();
        $option = [
            'headers' => $header,
            'body' => json_encode($body),
            'http_errors' => false
        ];

        $response = $client->request('POST', $url, $option);
        $status = $response->getStatusCode();

        $result = $response->getBody()->getContents();
        $json = json_decode($result, true);
        if ($status != 200) {
            Log::warn("huanxin:http_status: $status");
            throw new AppException($json['error'], 1);
        } else {
            return $json['entities'][0]['uuid'];
        }
    }


    public static function getUrl()
    {
        return sprintf("%s/%s/%s", self::$host, env('HUANXIN_ORGNAME'), env('HUANXIN_APPNAME'));
    }
}
