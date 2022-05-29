<?php

namespace App\Http\APIV1\Flower\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlowerResource extends JsonResource
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
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'price' => $this->price,
                'watering_time' => $this->watering_time,
                'watering_interval' => $this->watering_interval,
                'room_id' => $this->room_id,
            ]
        ];
    }
}