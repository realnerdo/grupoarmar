<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'company',
        'trade_name',
        'rfc',
        'address',
        'zipcode'
    ];

    public function services()
    {
        return $this->hasMany('App\Service');
    }
}
