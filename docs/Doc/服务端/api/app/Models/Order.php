<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/10/13
 * Time: 15:11
 */

namespace App\Models;


class Order extends BaseModel
{
    public $table = 'order';

    protected $fillable = [
        'buyer_id',
        'publish_info_id',
        'number',
        'address',
        'pay_mode_id',   //自定义类型
        'comment',
        'status'
    ];

}
