<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EquipmentDetail;
use App\Supplier;

class Maintenance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason',
        'description',
        'perform_date',
        'place',
        'responsible',
        'supplier_id'
    ];

    public function equipment_detail()
    {
        return $this->belongsTo('App\EquipmentDetail');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
