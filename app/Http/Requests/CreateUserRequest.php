<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            'user' => 'required|string|min:5|max:20',
            'name' => 'required|string|min:3|max:35',
            'phone' => ['required', 'digits:10'],
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'consent1_status' => ['required', 'accepted'],
            'consent2_status' => 'required|boolean',
            'consent3_status' => 'required|boolean',
        ];
    }


}
