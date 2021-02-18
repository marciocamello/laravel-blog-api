<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param $attributes
     * @return mixed
     */
    public static function createCategory($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return self::create($attributes);
        });
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function updateCategory($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->update($attributes);
        });
    }

    /**
     * @return mixed
     */
    public function deleteCategory()
    {
        return DB::transaction(function () {
            return $this->delete();
        });
    }
}
