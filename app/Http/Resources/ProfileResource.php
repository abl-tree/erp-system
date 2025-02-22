<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'business_type' => new BusinessTypeResource($this->businessType),
            'city' => $this->city,
            'country' => $this->country,
            'postal_code' => $this->postal_code,
            'role_id' => $this->role_id,
            'user_id' => $this->user_id,
        ];
    }
}
