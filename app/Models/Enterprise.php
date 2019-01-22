<?php
/**
 * 企业管理模型
 * 
 * @author Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Enterprise extends BaseModel{
    use SoftDeletes;
    public $table = 'enterprise';
    //设置主键
    public $primaryKey = 'id';
    protected $fillable=[
        'enterprise_name',
        'legal_person_name',
        'legal_person_id_card',
        'legal_preson_phone',
        'expire',
        'remark',
        'status',
    ];
    protected $dates = ['deleted_at'];    
}