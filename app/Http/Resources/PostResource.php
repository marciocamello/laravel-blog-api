<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="PostResource",
 *     description="Post resource",
 *     @OA\Xml(
 *         name="PostResource"
 *     )
 * )
 */
class PostResource extends JsonResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Models\Category[]
     */
    private $data;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this['title'],
            'description' => $this['description'],
            'created_at' => Carbon::parse($this['created_at'])->format('d-m-Y H:i:s'),
            'updated_at' => Carbon::parse($this['created_at'])->format('d-m-Y H:i:s'),
            'media' => $this->media
        ];
    }
}
