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

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'parent_id'
    ];

    protected $casts = [
        'updated_at' => 'datetime:d-m-Y H:i:s',
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];
}
