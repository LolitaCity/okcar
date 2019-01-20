<?php

namespace App\Models;


class RealnameAuthentication extends BaseModel
{
    public $table = 'realname_authentication';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'idcard_front_pic',
        'idcard_back_pic',
        'card_pic',
        'idcard_num',
        'realname',
        'status',
        'reason'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getStatusDescAttribute()
    {
        return array_get(config('okcar_const.authentication_type'), $this->status);
    }

}
