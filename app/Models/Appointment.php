<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'number_of_adults',
        'number_of_children',
        'hours_per_day',
        'user_id',
        'ski_instructor_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skiInstructor(): BelongsTo
    {
        return $this->belongsTo(SkiInstructor::class);
    }


    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}
