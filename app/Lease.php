<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leases';

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
        'rm_id',
        'user_id',
        'inc_id',
        'idcard',
        'date_start',
        'date_end',
        'vehicle',
        'vehicle_reg',
        'number',
        'typ_wifi',
        'typ_vehicle',
        'typ_price',
        'typ_booking',
        'typ_doposit',
        'net_pay',
        'meter_ws',
        'meter_ps',
        'status',
        'bkg_slip',
        'idcard_doc',
        'lease_doc',
        'checkout'
    ];

    public function room(){
        return $this->belongsTo('App\Room', 'rm_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function invoices(){
        return $this->hasMany('App\Invoice', 'les_id');
    }

    public function income(){
        return $this->belongsTo('App\Income', 'inc_id');
    }

}
