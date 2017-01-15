<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Client;
use App\ServiceDetail;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personal',
        'event',
        'date_start',
        'date_end',
        'status',
        'client_id'
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function service_details()
    {
        return $this->hasMany('App\ServiceDetail');
    }
}
