<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webconfig extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'webconfigs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'website',
        'address',
        'bbl',
        'bbl_logo',
        'kbsnk',
        'kbsnk_logo',
        'scb',
        'scb_logo',
        'bay',
        'bay_logo',
        'logo',
        'photo1',
        'photo2',
        'photo3',
        'photo4',
        'photo5'
    ];
}
