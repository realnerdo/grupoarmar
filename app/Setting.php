<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Picture;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'owner',
        'email',
        'phone',
        'address',
        'sidebar_logo_id',
        'service_logo_id'
    ];

    /**
     * Get the logo of the Sidebar.
     */
    public function sidebar_logo()
    {
        return $this->belongsTo('App\Picture', 'sidebar_logo_id');
    }

    /**
     * Get the logo of the Estimate PDF.
     */
    public function service_logo()
    {
        return $this->belongsTo('App\Picture', 'service_logo_id');
    }
}
