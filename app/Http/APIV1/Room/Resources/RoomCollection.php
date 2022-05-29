<?php

namespace App\Http\APIV1\Room\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomCollection extends JsonResource
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
            'data' => parent::toArray($request),
        ];
    }
}