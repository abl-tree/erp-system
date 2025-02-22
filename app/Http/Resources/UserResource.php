<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'two_factor' => $this->hasEnabledTwoFactorAuthentication(), // required in Vue for TwoFactoreAuthentication.
            'status_id' => $this->status_id,
            'status' => new StatusResource($this->whenLoaded('status')),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'businesses' => BusinessResource::collection($this->whenLoaded('businesses')),
            'business_name' => $this->business_name,
            'employee_profile' => $this->employee_profile,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone_number' => $this->phone_number,
            'profile' => new ProfileResource($this->profile),
            'profile_photo_path' => $this->profile_photo_path,
            'user_role_id' => $this->user_role_id,
        ];
    }
}
