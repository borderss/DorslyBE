<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Rating */
class RatingResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'point_of_interest_id' => $this->point_of_interest_id,
            'rating' => $this->rating,
        ];
    }
}
