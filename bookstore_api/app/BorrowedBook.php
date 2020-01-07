<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    protected $fillable = ['user_id', 'book_id', 'start'];
    public $timestamps = false;

    public function user() {

        return $this->belongsTo('App\User');
    }

    public function book() {
        
        return $this->hasOne('App\Book');
    }
}
