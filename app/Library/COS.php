<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/12
 * Time: 17:01
 */

namespace App\Library;

use App\Exceptions\AppException;

require(base_path('vendor/qcloud/cos-sdk-v5/cos-autoloader.php'));


class COS
{
    private $cosClient;

    public function __construct()
    {
        $this->cosClient = new \Qcloud\Cos\Client(array('region' => env('COS_REGION'),
            'credentials' => array(
                'appId' => env('COS_APPID'),
                'secretId' => env('COS_SECRET_ID'),
                'secretKey' => env('COS_SECRET_KEY'))));

    }

    public function upload($localFile, $key)
    {
        try {
            $result = $this->cosClient->putObject([
                'Bucket' => config("okcar.cos_bucket"),
                'Key' => $key,
                'Body' => fopen($localFile, 'rb')]);
            return config("okcar.cos_url") . $key;
        } catch (\Exception $e) {
            throw new AppException($e->getMessage(), 1);
        }
    }
}
