<?php

namespace App\Http\APIV1\Flower\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlowerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|integer',
            'watering_time' => 'required|date',
            'watering_interval' => 'required|integer',
            'room_id' => 'required|integer',
        ];
    }
}