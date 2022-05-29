<?php 

namespace App\Http\APIV1\Flower\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetFlowersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'sometimes|integer',
            'page_size' => 'sometimes|integer',
            'field' => 'sometimes|string',
            'order' => 'sometimes|string|in:asc,desc',
        ];
    }
}