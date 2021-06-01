<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'incomes';

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
    protected $fillable = ['date', 'income', 'remark'];

    public function invoices(){
        return $this->hasMany('App\Invoice', 'inc_id');
    }

    public function maintenances(){
        return $this->hasMany('App\Maintenance', 'inc_id');
    }

    public function leases(){
        return $this->hasMany('App\Lease', 'inc_id');
    }


}
