<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Rating */
class UserRatingResource extends JsonResource
{
    public function toArray($request)
    {
        $poi = new PointOfInterestResouce($this->PointOfInterest);

        return[
            'id' => $this->id,
            'point_of_interest' => [
                'id' => $poi->id,
                'name' => $poi->name,
            ],
            'rating' => $this->rating,
        ];
    }
}
