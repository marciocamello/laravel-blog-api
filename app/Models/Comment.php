<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(required={"content", "post_id", "user_id"}, @OA\Xml(name="Comment"))
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * @OA\Property(example="New comment to post")
     * @var string
     */
    public $content;

    /**
     * @OA\Property(example="1")
     * @var string
     */
    public $post_id;

    /**
     * @OA\Property(example="1")
     * @var string
     */
    public $user_id;

    protected $fillable = [
        'user_id',
        'post_id',
        'content'
    ];
}
