<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/10/13
 * Time: 15:11
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    use SoftDeletes;
    public $table = 'order';
    //设置主键
    public $primaryKey = 'id';
    protected $fillable = [
        'buyer_id',
        'publish_info_id',
        'number',
        'address',
        'pay_mode_id',   //自定义类型
        'comment',
        'status'
    ];
    protected $dates = ['deleted_at'];
}
