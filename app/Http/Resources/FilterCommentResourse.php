<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Rating */
class FilterCommentResourse extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'user_id'=> $this->user->id,
            'first_name'=> $this->user->first_name,
            'last_name'=> $this->user->last_name,
            'point_of_interest_id' => $this->PointOfInterest->id,
            'text' => $this->text,
        ];
    }
}
