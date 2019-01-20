<?php
/**
 * 地区信息表
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-20
 */
namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OkcarStoreHouse extends BaseModel{
    use SoftDeletes;
    public $table = 'okcar_store_house';
    //设置主键
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'area_id',
        'name'
    ];
    protected $dates = ['deleted_at'];
}

