<?php
/**
 * 仓库管理模型
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Models;

class StoreHouse extends BaseModel{
    public $table = 'store_house';
    protected $fillable=[
        'province_code',
        'city_code',
        'area_code',
        'type',
        'name',
        'address',
        'default_flag',
        'created_id',
        'updated_id'
    ];
}