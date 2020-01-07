<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['user_id'];

    public function books() {

        return $this->hasMany('App\SalesBook');
    }

    public function user() {

        return $this->belongsTo('App\User');
    }
}
