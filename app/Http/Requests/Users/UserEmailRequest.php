<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;

/**
 * Class UserEmailRequest
 * @package App\Http\Requests\Users
 */
class UserEmailRequest extends ApiFormRequest
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
            'email' => 'required|email|confirmed|max:255',
        ];
    }
}
