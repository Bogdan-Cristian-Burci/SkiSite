<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Appointment */
class AppoitmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'number_of_adults' => $this->number_of_adults,
            'number_of_children' => $this->number_of_children,
            'hours_per_day' => $this->hours_per_day,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user_id' => $this->user_id,
            'ski_instructor_id' => $this->ski_instructor_id,

            'user' => new UserResource($this->whenLoaded('user')),
            'skiInstructor' => new SkiInstructorResource($this->whenLoaded('skiInstructor')),
        ];
    }
}
