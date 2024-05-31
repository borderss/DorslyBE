<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Reservation */
class FilterReservationsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'point_of_interest_id' => $this->point_of_interest_id,
            'date' => $this->date,
            'number_of_people' => $this->number_of_people,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
