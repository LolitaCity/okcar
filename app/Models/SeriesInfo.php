<?php

namespace App\Models;


class SeriesInfo extends BaseModel
{
    public $table = 'series_info';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'brand_id',
        'manufacture'
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
