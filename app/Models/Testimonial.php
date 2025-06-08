<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['content'];

    protected $fillable = [
        'author_name',
        'content',
        'approved_status',
    ];

    protected function casts()
    {
        return [
            'approved_status' => 'boolean',
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }
}
