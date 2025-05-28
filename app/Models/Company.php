<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['name','description'];
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'logo_path',
        'socials',
    ];

    protected function casts()
    {
        return [
            'socials' => 'array',
        ];
    }
}
