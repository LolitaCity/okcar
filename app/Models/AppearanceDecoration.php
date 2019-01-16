<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/28
 * Time: 23:39
 */

namespace App\Models;


class AppearanceDecoration extends BaseModel
{
    public $table = 'appearance_decoration';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_id',
        'appearance',
        'decoration'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


}
