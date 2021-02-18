<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Schema(required={"title", "description"}, @OA\Xml(name="Post"))
 */
class Post extends Model
{
    use HasFactory;

    /**
     * @OA\Property(example="Post title")
     * @var string
     */
    public $title;

    /**
     * @OA\Property(example="Description content in text or html")
     * @var string
     */
    public $description;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description'
    ];

    protected $casts = [
        'updated_at' => 'datetime:d-m-Y H:i:s',
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function media()
    {
        return $this->hasOne('App\Models\Media', 'post_id', 'id');
    }

    /**
     * @param $attributes
     * @param $file
     * @return mixed
     */
    public static function createPostAndMedia($attributes, $file)
    {
        return DB::transaction(function () use ($file, $attributes) {

            $post = self::create([
                'user_id' => auth()->id(),
                'category_id' => $attributes['category_id'],
                'title' => $attributes['title'],
                'description' => $attributes['description']
            ]);

            if ($file) {

                Media::createMediaByPost($file, $post['id']);
            }

            return $post;
        });
    }

    /**
     * @param $attributes
     * @param $file
     * @return mixed
     */
    public function updatePostAndMedia($attributes, $file)
    {
        return DB::transaction(function () use ($file, $attributes) {

            $post = $this->update([
                'category_id' => $attributes['category_id'],
                'title' => $attributes['title'],
                'description' => $attributes['description']
            ]);

            if ($file) {

                $this->media->updateMedia($file);
            }

            return $post;
        });
    }

    /**
     * Delete post and media from post id
     */
    public function deletePostAndMedia()
    {
        DB::transaction(function () {

            if ($this->media) {

                $this->deleteMedia();
            }

            $this->delete();
        });
    }
}
