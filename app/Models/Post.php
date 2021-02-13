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
}
