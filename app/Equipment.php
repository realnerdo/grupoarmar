<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Group;
use App\Warehouse;
use App\Maintenance;
use App\Picture;
use App\Service;

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
        'serial',
        'stock',
        'brand_id',
        'group_id',
        'warehouse_id'
    ];

    public function pictures()
    {
        return $this->belongsToMany('App\Picture');
    }

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

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }
}
