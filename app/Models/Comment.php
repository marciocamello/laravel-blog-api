<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected $casts = [
        'updated_at' => 'datetime:Y-m-d h:m',
        'created_at' => 'datetime:Y-m-d h:m',
    ];

    /**
     * @param $attributes
     * @return mixed
     */
    public static function createComment($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return self::create($attributes);
        });
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function updateComment($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->update($attributes);
        });
    }

    /**
     * @return mixed
     */
    public function deleteComment()
    {
        return DB::transaction(function () {

            return $this->delete();
        });
    }
}
