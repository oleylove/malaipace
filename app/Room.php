<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rooms';

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
        'typ_id',
        'number',
        'building',
        'status',
        'meter_wo',
        'meter_wn',
        'meter_po',
        'meter_pn',
        'photo1',
        'photo2',
        'photo3',
        'photo4'
    ];

    public function type(){
        return $this->belongsTo('App\Type', 'typ_id');
    }

    public function lease(){
        return $this->hasOne('App\Lease', 'rm_id');
    }

    public function maintenances(){
        return $this->hasMany('App\Maintenance', 'rm_id');
    }
}
