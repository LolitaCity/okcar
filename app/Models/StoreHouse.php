<?php
/**
 * 仓库管理模型
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class StoreHouse extends BaseModel{
    use SoftDeletes;
    public $table = 'store_house';
    //设置主键
    public $primaryKey = 'id';
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
    protected $dates = ['deleted_at'];    
}