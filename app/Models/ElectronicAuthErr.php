<?php
/**
 * 电子公章使用授权失败记录模型
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Models;

class ElectronicAuthErr extends BaseModel{
    public $table = 'electronic_auth_err';
    //设置主键
    public $primaryKey = 'id';
    protected $fillable=[
        'auth_id',
        'remark'
    ];
}