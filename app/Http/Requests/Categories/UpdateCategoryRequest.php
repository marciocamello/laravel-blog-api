<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\ApiFormRequest;

/**
 * @OA\Schema(
 *      title="Update Category request",
 *      description="Update Category request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateCategoryRequest extends ApiFormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new category",
     *      example="Sports"
     * )
     *
     * @var string
     */
    public $name;

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
            'name' => ['required']
        ];
    }
}
