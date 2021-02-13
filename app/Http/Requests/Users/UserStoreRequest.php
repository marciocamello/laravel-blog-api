<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;

/**
 * Class UserStoreRequest
 * @package App\Http\Requests\Users
 */
class UserStoreRequest extends ApiFormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8'
        ];
    }
}
