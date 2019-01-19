<?php
/**
 * 订单收货地址管理模型
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-19
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAddress extends BaseModel{
    use SoftDeletes;
    public $table = 'order_address';
    //设置主键
    public $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'province',
        'city',
        'area',
        'type',   //自定义类型
        'name',
        'address'
    ];
}