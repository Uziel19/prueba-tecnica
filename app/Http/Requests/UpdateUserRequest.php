<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'user' => 'sometimes|string|min:5|max:50',
            'name' => 'sometimes|string|min:3|max:35',
            'phone' => ['sometimes', 'digits:10'],
            'password' => ['sometimes', Password::min(8)->letters()->numbers()->symbols()],
            'consent2_status' => 'sometimes|boolean',
            'consent3_status' => 'sometimes|boolean',
        ];
    }


    }

