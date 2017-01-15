<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
