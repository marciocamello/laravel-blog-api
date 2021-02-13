<?php

namespace App\Http\Requests\Medias;

use App\Http\Requests\ApiFormRequest;

/**
 * @OA\Schema(
 *      title="Store Media request",
 *      description="Store Media request body data",
 *      type="object",
 *      required={"post_id", "file"}
 * )
 */
class StoreMediaRequest extends ApiFormRequest
{
    /**
     * @OA\Property(
     *      title="post_id",
     *      description="Post relation to comment",
     *      example="1"
     * )
     *
     * @var string
     */
    public $post_id;

    /**
     * @OA\Property(
     *      title="file",
     *      description="Media file name",
     *      example="file.jpg"
     * )
     *
     * @var string
     */
    public $file;

    /**
     * @OA\Property(
     *      title="file_info",
     *      description="Media file info from phpfileinfo",
     *      example="{mime: 'jpg'}"
     * )
     *
     * @var string
     */
    public $file_info;

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
            //
        ];
    }
}
