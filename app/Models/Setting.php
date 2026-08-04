<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'hero_title_en',
        'hero_title_ps',
        'hero_description_en',
        'hero_description_ps',
        'footer_text_en',
        'footer_text_ps',
        'mission_vision_en',
        'mission_vision_ps',
        'about_digital_library_en',
        'about_digital_library_ps',
        'purpose_en',
        'purpose_ps',

    ];
}