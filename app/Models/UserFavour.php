<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/9/2
 * Time: 19:30
 */

namespace App\Models;

class UserFavour extends BaseModel
{
    public $table = 'user_favour';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'publish_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    public function publishInfo()
    {
        return $this->hasOne('App\Models\PublishInfo', 'id', 'publish_id');
    }
}
