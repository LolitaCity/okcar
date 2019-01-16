<?php
return [
    'vcode_expire_time' => 30 * 60,
    'max_vcode_per_day' => 10,


    // cos存储
    'cos_region' => env('COS_REGION'),
    'cos_appid' => env('COS_APPID'),
    'cos_secret_key' => env('COS_SECRET_KEY'),
    'cos_secret_id' => env('COS_SECRET_ID'),

    //短信
    'sign_id' => env('SMS_SIGN_ID'),
    'tpl_id' => env('SMS_TPL_ID'),
    'app_key' => env('SMS_APP_KEY'),
    'app_id' => env('SMS_APP_ID'),


    'cos_bucket' => 'auth-pics-1257217643',
    'cos_url' => 'https://auth-pics-1257217643.cos-website.ap-chengdu.myqcloud.com/',


    'error' => [
        'not_login' => 10001,
        'expired' => 10002,
    ],

    'normal_brand_id' => [102,36,56,124],

    // 客服电话
    'kefu_tel' => '0769-88283689',

    // 分享地址
    'share_url' => 'https://info.okaycar.com.cn/mobile?id=%s',

    'color' => ['白色', '黑色'],
    'kefu_huanxin_id' => 'kefuchannelimid_220151',
    'kefu_huanxin_agent' => 'agent',

    'no_check_phone' => '11111111111',
    'no_check_vcode' => '111111',
];
