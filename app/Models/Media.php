<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(required={"file", "post_id"}, @OA\Xml(name="Media"))
 */
class Media extends Model
{
    use HasFactory;

    /**
     * @OA\Property(example="file.jpg")
     * @var string
     */
    public $file;

    /**
     * @OA\Property(example="1")
     * @var string
     */
    public $post_id;
}
