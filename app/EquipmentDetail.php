<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\Maintenance;

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

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance');
    }
}
