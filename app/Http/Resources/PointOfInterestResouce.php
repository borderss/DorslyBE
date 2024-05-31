<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

/** @mixin \App\Models\PointOfInterest */
class PointOfInterestResouce extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'gps_lng' => $this->gps_lng,
            'gps_lat' => $this->gps_lat,
            'distance' => $this->distance ?? null,
            'country' => $this->country,
            'images' => URL::signedRoute('point_of_interest.images',['point_of_interest' => $this->id]),
            'opens_at' => $this->opens_at,
            'closes_at' => $this->closes_at,
            'is_open_round_the_clock' => $this->is_open_round_the_clock,
            'is_takeaway' => $this->is_takeaway,
            'is_on_location' => $this->is_on_location,
            'available_seats' => $this->available_seats,
            'review_count' => $this->review_count,
            'avg' => $this->avgRating,
        ];
    }
}
