<?php
/**
 * 地区信息表
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-20
 */
namespace App\Models;

use App\Models\BaseModel;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends BaseModel{
    //use SoftDeletes;
    public $table = 'china_area';
    //设置主键
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'state',
        'area',
        'province',
        'city',
        'district',//
        'sort'
    ];
}

