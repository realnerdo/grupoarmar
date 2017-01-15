<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;

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
        'responsible'
    ];

    public function equipment()
    {
        return $this->belongsTo('App\Equipment');
    }
}
