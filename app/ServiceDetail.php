<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\Equipment;

class ServiceDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'equipment_id'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function Equipment()
    {
        return $this->belongsTo('App\Equipment');
    }
}
