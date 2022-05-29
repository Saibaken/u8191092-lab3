<?php

namespace App\Http\APIV1\Flower\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// JSON API resource for array of flowers with pagination
class FlowerCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pagination = parent::toArray($request);
        return [
            'data' => $pagination['data'],
            'meta' => [
                'pagination' => [
                    'total' => $this->resource->total(),
                    'count' => $this->resource->count(),
                    'per_page' => $this->resource->perPage(),
                    'current_page' => $this->resource->currentPage(),
                    'total_pages' => $this->resource->lastPage(),
                ],
                'links' => $pagination['links'],
                'prev_page' => $this->resource->previousPageUrl(),
                'next_page' => $this->resource->nextPageUrl(),
            ],
        ];
    }
}