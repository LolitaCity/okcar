<?php
/**
 * 订单成长记录模型
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-19
 */
namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderOptionRecord extends BaseModel{
    use SoftDeletes;
    public $table = 'order_option_record';
    //设置主键
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'user_id',
        'remark',
    ];
}

