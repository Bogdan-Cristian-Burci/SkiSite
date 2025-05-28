<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Webcam extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['title'];
    protected $fillable = [
        'title',
        'iframe_link',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
        ];
    }
}
