<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'gps_lng' => $this->gps_lng,
            'gps_lat' => $this->gps_lat,
            'is_admin' => $this->is_admin,
            'roles' => $this->getRoleNames(),
            'is_promotion_emails_allowed' => $this->is_promotion_emails_allowed,
            'is_security_notices_allowed' => $this->is_security_notices_allowed,
            'is_reservation_info_allowed' => $this->is_reservation_info_allowed,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
