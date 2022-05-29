<?php 

namespace App\Http\APIV1\Common;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorJsonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
                'code' => $this->getCode(),
                'message' => $this->getMessage(),
        ];
    }
}