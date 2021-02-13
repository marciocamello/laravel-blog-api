<?php

namespace App\Http\Requests;

/**
 * Class LoginRequest
 * @package App\Http\Requests
 */
class LoginRequest extends ApiFormRequest
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
        return [
            'email' => 'required|exists:App\Models\User,email',
            'password' => 'required'
        ];
    }
}
