<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesBook extends Model
{
    public $timestamps = false;
    protected $fillable = ['book_id', 'sale_id', 'amount'];

    public function sale() {

        return $this->belongsTo('App\Sale');
    }
    public function books() {

        return $this->hasOne('App\Book');
    }
}
