<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/9/25
 * Time: 0:08
 */

namespace App\Models;


class Appearance  extends BaseModel
{
    public $table = 'appearance';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_id',
        'color',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
