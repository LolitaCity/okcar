<?php
//车规
const ZHONGGUIGUOCHAN = '1';
const MEIGUI = '2';
const JIAGUI = '3';
const ZHONGDONG = '4';
const OUBAN = '5';
const MOBAN = '6';

//商家类型
const FOURS = '1';
const ZHANTING = '2';
const ZIYUAN = '3';
const GANGKOU = '4';

//发布状态
const STATUS_UP = '0';
const STATUS_DOWN = '1';

//认证状态
const AUTHENTICATION_NO = '-1';
const AUTHENTICATION_SUC = '0';
const AUTHENTICATION_FAIL = '1';
const AUTHENTICATION_ING = '2';

const STOCK_XIANHUO = '0';
const STOCK_QIHUO = '1';

const PAGE_NUM = 100;

// 分页默认数目
const PAGE_SIZE = 30;
return [
    'car_rule' => [
        ZHONGGUIGUOCHAN => '中规国产',
        MEIGUI => '美规',
        JIAGUI => '加规',
        ZHONGDONG => '中东',
        OUBAN => '欧版',
        MOBAN => '墨版',
    ],
    'enterprise_type' => [
        FOURS => '4s店',
        ZHANTING => '展厅',
        ZIYUAN => '资源',
        GANGKOU => '港口批发商',
    ],
    'authentication_type' => [
        AUTHENTICATION_NO => '未提交',
        AUTHENTICATION_SUC => '通过',
        AUTHENTICATION_FAIL => '未通过',
        AUTHENTICATION_ING => '待认证',
    ],

    'sale_area' => [
        '0' => '全国',
        '1' => '东区',
        '2' => '南区',
        '3' => '西区',
        '4' => '大北',
        '5' => '小北'
    ],
    'formalities' => [
        '0' => '随车',
        '1' => '3天内',
        '2' => '7天内',
        '3' => '15天内',
        '4' => '30天内',

    ],
    'deal_time' => [
        '0' => '不限',
        '1' => '3天内',
        '2' => '7天内',
        '3' => '15天内',
        '4' => '30天内',
    ],
    'ticket_source' => [
        '0' => '均可',
        '1' => '店票',
        '2' => '汽贸票'
    ],
    'ticket_type' => [
        '0' => '均可',
        '1' => '增票',
        '2' => '后票'
    ],
    'produce_time' => [
        '0' => '3个月内',
        '1' => '半年内',
        '2' => '一年内',
        '3' => '1-3年'
    ],
    'stock' => [
        STOCK_XIANHUO => '现货',
        STOCK_QIHUO => '期货',
    ],
    'page_size' => PAGE_SIZE
];
