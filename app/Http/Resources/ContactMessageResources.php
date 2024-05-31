<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ContactMessage */
class ContactMessageResources extends JsonResource
{
    public function toArray($request)
    {
        return[
            'first_name' => $this->first_name,
            'last_name'=>$this->last_name,
            'email' => $this->email,
            'text' => $this->text,
            'terms_conditions' => $this->terms_conditions,
            'entities' => $this->entity,
        ];
    }
}
