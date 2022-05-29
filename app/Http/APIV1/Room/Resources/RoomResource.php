<?php

namespace App\Http\APIV1\Room\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\APIV1\Flower\Resources\FlowerResource;

class RoomResource extends JsonResource
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
            'name' => $this->name,
            'capacity' => $this->capacity,
            'flowers' => FlowerResource::collection($this->flowers),
        ];
    }
}