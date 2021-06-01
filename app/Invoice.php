<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

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
        'les_id',
        'date',
        'date_pay',
        'pay_date',
        'delay_date',
        'meter_wo',
        'meter_wn',
        'meter_wu',
        'meter_wpu',
        'meter_wtp',
        'meter_po',
        'meter_pn',
        'meter_pu',
        'meter_ppu',
        'meter_ptp',
        'typ_centric',
        'typ_wifi',
        'typ_vehicle',
        'typ_mulct',
        'les_price',
        'net_pay',
        'typ_doposit',
        'status',
        'slip'
    ];

    public function lease(){
        return $this->belongsTo('App\Lease', 'les_id');
    }

    public function income(){
        return $this->belongsTo('App\Income', 'inc_id');
    }

}
