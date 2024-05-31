<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

/** @mixin \App\Models\TitlePhotos */
class TitlePhotoResouce extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'image' => URL::signedRoute('TitlePhotos.image',['TitlePhoto' => $this->id]),
            'point_of_interest_id' => new PointOfInterestResouce($this->PointOfInterest),
        ];
    }
}
