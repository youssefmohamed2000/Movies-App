<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo' => 'nullable|image',
            'fav_icon' => 'nullable|image',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'email' => 'nullable|string|email',
        ];
    }
}
