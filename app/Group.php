<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    public function equipments()
    {
        return $this->hasMany('App\Equipment');
    }
}
