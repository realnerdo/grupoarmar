<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Group;
use App\Warehouse;
use App\Service;
use App\EquipmentDetail;

class Equipment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'folio',
        'title',
        'description',
        'stock',
        'brand_id',
        'group_id',
        'warehouse_id'
    ];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function equipment_details()
    {
        return $this->hasMany('App\EquipmentDetail');
    }
}
