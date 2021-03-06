<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\Equipment;
use App\EquipmentDetail;

class ServiceDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'price',
        'total',
        'equipment_detail_id',
        'equipment_id',
        'service_id'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function equipment_detail()
    {
        return $this->belongsTo('App\EquipmentDetail');
    }

    public function equipment()
    {
        return $this->belongsTo('App\Equipment');
    }
}
