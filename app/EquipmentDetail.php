<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\Maintenance;
use App\ServiceDetail;

class EquipmentDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'folio'
    ];

    public function equipment()
    {
        return $this->belongsTo('App\Equipment');
    }

    public function service_details()
    {
        return $this->hasMany('App\ServiceDetail');
    }

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance');
    }
}
