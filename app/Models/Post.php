<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function media()
    {
        return $this->hasOne('App\Models\Media', 'post_id', 'id');
    }
}
