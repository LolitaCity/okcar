<?php

namespace App\Models;


class BrandInfo extends BaseModel
{
    public $table = 'brand_info';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'logo',
        'pinyin'
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

    public function modelInfoList()
    {
        return $this->hasMany('App\Models\ModelInfo', 'brand_id');
    }

}
