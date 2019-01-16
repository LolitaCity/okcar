<?php

namespace App\Models;

use App\Library\Util;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'phone', 'name', 'head_img', 'sale_brand', 'company_name', 'area', 'password','selfdesc','huanxin_id','huanxin_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function getRealnameAuthenticationAttribute()
    {
        return array_get($this->realnameAuth, 'status', AUTHENTICATION_NO);
    }

    public function getRealnameAuthenticationDescAttribute()
    {
        return array_get(config('okcar_const.authentication_type'), $this->getRealnameAuthenticationAttribute());
    }

    public function getEnterpriseAuthenticationAttribute()
    {
        return array_get($this->enterpriseAuth, 'status', AUTHENTICATION_NO);
    }

    public function getEnterpriseAuthenticationDescAttribute()
    {
        return array_get(config('okcar_const.authentication_type'), $this->getEnterpriseAuthenticationAttribute());
    }

    public function getRealnameAuthenticationReasonAttribute()
    {
        return array_get($this->realnameAuth, 'reason', '');
    }

    public function getEnterpriseAuthenticationReasonAttribute()
    {
        return array_get($this->enterpriseAuth, 'reason', '');
    }

    public function getAreaDescAttribute()
    {
        return Util::getAreaDesc($this->area);
    }
    public function getEnterpriseNameAttribute()
    {
        return array_get($this->enterpriseAuth, 'enterprise_name', '');
    }


    public function realnameAuth()
    {
        return $this->hasOne('App\Models\RealnameAuthentication', 'user_id');
    }

    public function enterpriseAuth()
    {
        return $this->hasOne('App\Models\EnterpriseAuthentication', 'user_id');
    }


    public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }

    public function favourlist() {
        return $this->belongsToMany('App\Models\PublishInfo', 'user_favour', 'user_id', 'publish_id')
            ->withPivot(['id', 'created_at', 'updated_at']);
    }

}
