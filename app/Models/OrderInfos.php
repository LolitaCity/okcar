<?php
/**
 * 订单详情表
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-19
 */
namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderInfos extends BaseModel{
    use SoftDeletes;
    public $table = 'order_info';
    //设置主键
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'order_id',
        'type',
        'enterprise_name',
        'model_info',
        'custom_model',   //自定义类型
        'appearance',
        'decoration',
        'stock',
        'quantity',
        'sale_price',
        'source',
        'sale_area',
        'comment',
        'pics',
        'access_count',
        'formalities',
        'expire',        
        'ticket_type',
        'brand_name',
        'brand_pinyin',        
        'series_name',
        'model',
        'produce_year',
        'guide_price',
        'manufactures',
        'rule',
    ];
    protected $dates = ['deleted_at'];
}

