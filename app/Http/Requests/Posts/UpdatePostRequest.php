<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\ApiFormRequest;

/**
 * @OA\Schema(
 *      title="Update Post request",
 *      description="Update Post request body data",
 *      type="object",
 *      required={"name", "description"}
 * )
 */
class UpdatePostRequest extends ApiFormRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Name of the new post",
     *      example="Sports"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new post",
     *      example="Sports"
     * )
     *
     * @var string
     */
    public $description;

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
            'title' => ['required', 'max:250', 'unique:posts,id'],
            'description' => ['required'],
            'category_id' => ['required'],
        ];
    }
}
