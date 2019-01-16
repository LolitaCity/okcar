<?php

namespace App\Models;

use App\Library\Util;

class EnterpriseAuthentication extends BaseModel
{
    public $table = 'enterprise_authentication';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'enterprise_name',
        'enterprise_type',
        'legal_person_name',
        'area',
        'pic1',
        'pic2',
        'pic3',
        'pic4',
        'pic5',
        'status',
        'reason',
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

    public function getAreaDescAttribute()
    {
        return Util::getAreaDesc($this->area);
    }

    public function getEnterpriseTypeDescAttribute() {
        return config('okcar_const.enterprise_type.' . $this->enterprise_type, '');
    }

    public function getPicsAttribute() {
        return array_filter([$this->pic1, $this->pic2, $this->pic3, $this->pic4, $this->pic5]);
    }

}
