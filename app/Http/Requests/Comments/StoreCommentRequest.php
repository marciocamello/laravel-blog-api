<?php

namespace App\Http\Requests\Comments;

use App\Http\Requests\ApiFormRequest;

/**
 * @OA\Schema(
 *      title="Store Post request",
 *      description="Store Post request body data",
 *      type="object",
 *      required={"user_id", "post_id", "content"}
 * )
 */
class StoreCommentRequest extends ApiFormRequest
{
    /**
     * @OA\Property(
     *      title="user_id",
     *      description="User ID to create this comment",
     *      example="1"
     * )
     *
     * @var string
     */
    public $user_id;

    /**
     * @OA\Property(
     *      title="$post_id",
     *      description="Post ID relation to this comment",
     *      example="1"
     * )
     *
     * @var string
     */
    public $post_id;

    /**
     * @OA\Property(
     *      title="content",
     *      description="Description of the new comment",
     *      example="A new comment to post"
     * )
     *
     * @var string
     */
    public $content;

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
