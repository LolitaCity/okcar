<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/26
 * Time: 20:15
 */

namespace App\Models;


class ModelInfo extends BaseModel
{
    public $table = 'model_info';

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
        'name'
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

    public function brandInfo()
    {
        return $this->hasOne('App\Models\BrandInfo', 'id', 'brand_id');
    }

    public function appearance()
    {
        return $this->hasMany('App\Models\Appearance', 'model_id', 'id');
    }

    public function decoration()
    {
        return $this->hasMany('App\Models\Decoration', 'model_id', 'id');
    }

    public function manufactureInfo() {
        return $this->hasOne('App\Models\ManufactureInfo', 'id', 'manufacture_id');
    }

    public function getRuleDescAttribute()
    {
        return array_get(config('okcar_const.car_rule'),$this->rule);
    }

    public function getPriorityAttribute()
    {
        return array_get($this->manufactureInfo, 'priority', '');
    }
}
