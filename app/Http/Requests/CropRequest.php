<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CropRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = $this->route()->getName();

        $rule = [
            'name' => 'required|string|max:50',
            'price' => 'required|integer',
            'number' => 'required|integer',
        ];

        if ($route === 'crops.store' ||
            ($route === 'crops.update' && $this->file('image'))) {
            $rule['image'] = 'required|file|image|mimes:jpg,png';
        }
        return $rule;
    }
}
