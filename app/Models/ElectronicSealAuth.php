<?php
/**
 * 电子公章使用授权模型
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ElectronicSealAuth extends BaseModel{
    use SoftDeletes;
    public $table = 'electronic_seal_auth';
    //设置主键
    public $primaryKey = 'id';
    protected $fillable=[
        'status',
        'remark',
        'expire',
        'created_id'
    ];
    protected $dates = ['deleted_at'];    
}