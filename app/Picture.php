<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;

class Picture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url'
    ];

    public function equipments()
    {
        return $this->belongsToMany('App\Equipment');
    }
}
