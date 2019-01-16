<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/31
 * Time: 23:45
 */

namespace App\Models;


use App\Library\Util;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishInfo extends BaseModel
{
    use SoftDeletes;
    public $table = 'public_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'enterprise_name',
        'model_info_id',
        'custom_model',   //自定义类型
        'appearance',
        'decoration',
        'stock',
        'sale_price',
        'source',
        'quantity',
        'comment',
        'pics',
        'status',
        'access_count',
        'formalities',
        'expire',
        'sale_area',
        'ticket_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'quantity',
        'deleted_at',
    ];

    public function modelInfo()
    {
        return $this->hasOne('App\Models\ModelInfo', 'id', 'model_info_id');
    }

    public function salerUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getSourceDescAttribute()
    {
        return Util::getAreaDesc($this->source);
    }

    public function getSaleAreaDescAttribute() {
        $desc = Util::getAreaDesc($this->sale_area);
        if (empty($desc) && is_numeric($this->sale_area)) {
            $desc = array_get(config("okcar_const.sale_area"), $this->sale_area);
        }
        return $desc;
    }

    public function getFormalitiesDescAttribute() {
        $formalities = $this->formalities;
        $desc = array_get(config('okcar_const.formalities'), $formalities);
        return $desc;
    }
}
