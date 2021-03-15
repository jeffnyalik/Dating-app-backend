<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Gender\GenderResource;
use App\Http\Resources\Lookup\CountryResource;
use App\Http\Resources\Photos\PhotoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->name,
            'email' => $this->email,
            'knownAs' => $this->known_as,
            'bio' => $this->bio,
            'lookingFor' => $this->looking_for,
            'last_active' => $this->last_active,
            'hobbies' => $this->interests,
            'language' => $this->language,
            'city' => $this->city,
            'dob' => $this->dob,
            'image' => $this->image,
            'gender' => new GenderResource($this->genders),
            'country' => new CountryResource($this->countries),


        ];
    }
}
