<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Schema(required={"file", "post_id"}, @OA\Xml(name="Media"))
 */
class Media extends Model
{
    protected $table = 'medias';

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

    protected $casts = [
        'file_info' => 'array',
        'updated_at' => 'datetime:Y-m-d h:m',
        'created_at' => 'datetime:Y-m-d h:m',
    ];

    protected $fillable = [
        'file',
        'file_info',
        'post_id'
    ];

    protected $appends = [
        'file_url'
    ];

    public function getFileUrlAttribute($value)
    {
        return config('app.url') . "/storage/medias/" . $this->attributes['file'];
    }
}
