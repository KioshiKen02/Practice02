<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can implement any authorization logic here.
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional avatar validation
        ];
    }
}
