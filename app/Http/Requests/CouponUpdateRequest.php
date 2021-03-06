<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discount'  => 'required|numeric|min:0|max:1',
            'starts_at' => 'required|date',
            'ends_at'   => 'required|date|after:starts_at',
        ];
    }
}
