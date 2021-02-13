<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *      title="Login User request",
 *      description="Login User request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginRequest extends ApiFormRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="User email",
     *      example="admin@laravel.blog"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="User Password",
     *      example="q1w2e3r4"
     * )
     *
     * @var string
     */
    public $password;


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
