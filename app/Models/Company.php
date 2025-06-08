<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['name','description', 'about_title', 'about_content'];
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'logo_path',
        'socials',
        'about_title',
        'about_content',
        'about_image_path',
    ];

    protected function casts()
    {
        return [
            'socials' => 'array',
        ];
    }
}
