<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'business_type_id' => $this->business_type_id,
            'country' => $this->country,
            'custom_url' => $this->custom_url,
            'state' => $this->state,
            'user_id' => $this->user_id
        ];
    }
}
