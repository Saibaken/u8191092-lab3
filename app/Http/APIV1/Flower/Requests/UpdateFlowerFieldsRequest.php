<?php

namespace App\Http\APIV1\Flower\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlowerFieldsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        // All fields are optional.
        return [
            'id' => 'sometimes|integer',
            'name' => 'sometimes|string',
            'price' => 'sometimes|integer',
            'watering_time' => 'sometimes|date',
            'watering_interval' => 'sometimes|integer',
            'room_id' => 'sometimes|integer',
        ];
    }
}