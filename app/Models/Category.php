<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     public function books()
    {
        return $this->hasMany(Book::class);
    }
    protected $fillable = ['name'];

    public function getName()
    {
        return $this->{'name_' . app()->getLocale()} ?? $this->name_en;
    }
    public function show($id)
{
    $book = Book::with('category')->findOrFail($id);
    return view('books.show', compact('book'));
}
}
