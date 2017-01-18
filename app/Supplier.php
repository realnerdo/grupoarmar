<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Maintenance;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'phone',
        'address'
    ];

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance');
    }
}
