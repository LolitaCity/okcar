<?php
/**
 * Created by IntelliJ IDEA.
 * User: zicong
 * Date: 2018/10/14
 * Time: 10:15
 */

namespace App\Models;


class OrderInfo extends BaseModel
{
    public $table = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'series',
        'series_id',
        'model',
        'produce_year',
        'guide_price',
        'manufactures',
        'rule',
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        //'updated_at',
    ];

    public function publicInfo()
    {
        return $this->hasOne('App\Models\PublishInfo', 'id', 'publish_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'buyer_id');
    }

    public function payMode()
    {
        return $this->hasOne('App\Models\PayModeInfo', 'id', 'pay_mode_id');
    }

    public function modelInfo()
    {
        return $this->hasManyThrough(
            'App\Models\ModelInfo',
            'App\Models\PublishInfo',
            'id',
            'id',
            'publish_id',
            'model_info_id'
        );
    }

    public function salerInfo()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\PublishInfo',
            'id',
            'id',
            'publish_id',
            'user_id'
        );
    }

}
