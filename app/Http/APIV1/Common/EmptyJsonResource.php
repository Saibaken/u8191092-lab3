<?php

namespace App\Http\APIV1\Common;

use Illuminate\Http\Resources\Json\JsonResource;

class EmptyJsonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => null,
        ];
    }
}