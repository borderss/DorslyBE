<?php

namespace App\Http\Resources;

use App\Models\PointOfInterest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

/** @mixin \App\Models\Product */
class ProductResourse extends JsonResource
{
    public function toArray($request)
    {
        $asd = '';

        try {
            $asd = URL::signedRoute('product.image',['product' => $this->id]);
        } catch (\Exception $e) {
            $asd = $this->image;
        }

        return [
            'id' => $this->id,
            'name'=>$this->name,
            'description' => $this->description,
            'point_of_interest_id' => $this->PointOfInterest->id,
            'ingredients' => $this->ingredients,
            'image' => $asd,
            'price' => $this->price,
        ];
    }
}
