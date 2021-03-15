<?php

namespace App\Http\Resources\Photos;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
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
            'photoUrl' => $this->photos,
            'title' => $this->caption,
        ];
    }
}
