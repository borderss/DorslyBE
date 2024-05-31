<?php

namespace App\Http\Resources;

use App\Models\PointOfInterest;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Comment */
class UserCommentResource extends JsonResource
{
    public function toArray($request)
    {
        $poi = PointOfInterest::find($this->point_of_interest_id);

        return[
            'id' => $this->id,
            'point_of_interest' => [
                'id' => $poi->id,
                'name' => $poi->name,
            ],
            'date' => Carbon::createFromDate($this->created_at)->format('Y-m-d H:i'),
            'text' => $this->text,
        ];
    }
}
