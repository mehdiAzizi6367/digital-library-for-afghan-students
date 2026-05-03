<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory,SoftDeletes;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
        
    }
  
   protected $fillable = [
    'title_en',
    'title_ps',
    'title_fa',
    'description_en',
    'description_ps',
    'description_fa',
    'author',
    'edition',
    'category_id',
    'rejection_reason',
    'isbn',
    'file_path',
    'thumbnail',
    'uploaded_by',
    'status',
    ];

    protected $appends = ['title'];
    public function user() {
       return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // retrive data from data base
    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()} ?? $this->title_en;
    }

    public function getDescription()
    {
        return $this->{'description_' . app()->getLocale()} ?? $this->description_en;
    }


       // Auto delete files when book is deleted
    protected static function booted()
    {
        static::deleting(function ($book) {

            if ($book->file_path) {
                Storage::disk('public')->delete($book->file_path);
            }
            if ($book->thumbnail) {
                Storage::disk('public')->delete($book->thumbnail);
            }

        });
    }
    // App\Models\Book.php
    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }

}
