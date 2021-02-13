<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(required={"name"}, @OA\Xml(name="Category"))
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @OA\Property(example="Sports")
     * @var string
     */
    public $name;
}
