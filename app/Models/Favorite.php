<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'book_id'
    ];
        // The user who favorited
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    // app/Models/Favorite.php


}