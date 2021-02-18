<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        'updated_at' => 'datetime:d-m-Y H:i:s',
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];

    protected $fillable = [
        'file',
        'file_info',
        'post_id'
    ];

    protected $appends = [
        'file_url'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getFileUrlAttribute($value)
    {
        return config('app.url') . "/storage/medias/" . $this->attributes['file'];
    }

    /**
     * @param $file
     * @return string
     */
    public static function mediaSaveToStore($file)
    {
        $name = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $nameFile = "{$name}.{$extension}";

        $file->storePubliclyAs('medias', $nameFile, 'public');

        return $nameFile;
    }

    /**
     * @param $file
     * @param $postId
     * @return mixed
     */
    public static function createMediaByPost($file, $postId)
    {
        return DB::transaction(function () use ($file, $postId) {

            return self::create([
                'post_id' => $postId,
                'file' => self::mediaSaveToStore($file),
                'file_info' => [],
            ]);
        });
    }

    /**
     * @param $file
     * @return mixed
     */
    public function updateMedia($file)
    {
        return DB::transaction(function () use ($file) {

            $nameFile = $this['file'];

            Storage::disk('public')->delete("medias/$nameFile");
            $file->storePubliclyAs('medias', $nameFile, 'public');

            return $this->update([
                'file' => $nameFile,
                'file_info' => [],
            ]);
        });
    }

    /**
     * @return mixed
     */
    public function deleteMedia()
    {
        return DB::transaction(function () {
            $this->delete();
            Storage::disk('public')->delete("medias/$this[file]");
        });
    }
}
