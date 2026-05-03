<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'hero_title',
        'hero_description',
        'footer_text'
    ];
}