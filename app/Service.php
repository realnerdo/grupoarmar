<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Client;
use App\ServiceDetail;
use Jenssegers\Date\Date;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event',
        'date_start',
        'date_end',
        'total',
        'status',
        'client_id'
    ];

    /**
     * Dates as Carbon instances
     *
     * @var array
     */
    protected $dates = ['date_start', 'date_end'];

    /**
     * Scope for pending
     *
     * @param  $query
     */
    public function scopePending($query)
    {
        $query->where('date_start', '>', Date::now());
    }

    /**
     * Scope for active
     *
     * @param  $query
     */
    public function scopeActive($query)
    {
        $query->whereBetween('date_start', [Date::now(), 'date_end']);
    }

    /**
     * Scope for finished
     *
     * @param  $query
     */
    public function scopeFinished($query)
    {
        $query->where('date_end', '<', Date::now());
    }

    /**
     * Mutator for date_start attribute
     *
     * @param string $date
     */
    public function setDateStartAttribute($date)
    {
        $this->attributes['date_start'] = Date::createFromFormat('Y-m-d', $date, 'America/Merida')->format('Y-m-d');
    }

    /**
     * Mutator for date_end attribute
     *
     * @param string $date
     */
    public function setDateEndAttribute($date)
    {
        $this->attributes['date_end'] = Date::createFromFormat('Y-m-d', $date, 'America/Merida')->format('Y-m-d');
    }

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
