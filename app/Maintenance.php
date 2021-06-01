<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maintenances';

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
    protected $fillable = ['rm_id', 'date', 'ready_date' ,'detail', 'status', 'price', 'date_done'];

    public function room(){
        return $this->belongsTo('App\Room', 'rm_id');
    }
}
