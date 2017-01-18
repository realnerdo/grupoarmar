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
        'responsible',
        'supplier_id',
        'equipment_detail_folio'
    ];

    // public function equipment_detail()
    // {
    //     return $this->belongsTo('App\EquipmentDetail');
    // } // TODO: Change to folio

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
