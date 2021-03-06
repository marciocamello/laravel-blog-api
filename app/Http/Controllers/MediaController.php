<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medias\StoreMediaRequest;
use App\Http\Requests\Medias\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

/**
 * Class MediaController
 * @package App\Http\Controllers
 */
class MediaController extends CustomController
{
    /**
     * @OA\Get(
     *     path="/medias",
     *     tags={"Medias"},
     *     operationId="index",
     *     summary="List all medias",
     *     description="Get medias list",
     *      security={{"bearer_token":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MediaResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
     */
    public function index()
    {
        return new MediaResource(Media::paginate(5));
    }

    /**
     * @OA\Post(
     *     path="/medias",
     *     tags={"Medias"},
     *     operationId="store",
     *     summary="Add a new media to the blog",
     *     description="Create a media and return that",
     *      security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         description="Media object that needs to be added to the blog",
     *         required=true,
     *             @OA\JsonContent(ref="#/components/schemas/StoreMediaRequest")
     *     ),
     *     @OA\RequestBody(
     *         description="Media object that needs to be added to the blog",
     *         required=true,
     *     ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
     */
    public function store(StoreMediaRequest $request)
    {
        try {

            $validated = $request->validated();
            $file = $request->file('file');
            $media = Media::createMediaByPost($file, $validated['post_id']);

            return response()->json([
                'message' => __('dashboard.medias.created'),
                'response' => $media->toArray()
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.medias.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/medias/{id}",
     *      operationId="show",
     *      tags={"Medias"},
     *      summary="Get media information",
     *      description="Returns media data",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Media id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Media")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(Media $media)
    {
        try {

            return response()->json([
                'message' => __('dashboard.medias.show'),
                'response' => $media
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.medias.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Put(
     *      path="/medias/{id}",
     *      operationId="update",
     *      tags={"Medias"},
     *      summary="Update existing media",
     *      description="Returns updated media data",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Media id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCommentRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Media")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        try {

            $file = $request->file('file');
            $media->updateMedia($file);

            return response()->json([
                'message' => __('dashboard.medias.updated'),
                'response' => $media->toArray()
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.medias.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/medias/{id}",
     *      operationId="destroy",
     *      tags={"Medias"},
     *      summary="Delete existing media",
     *      description="Deletes a record and returns no content",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Media id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Media $media)
    {
        try {

            $media->deleteMedia();

            return response()->json([
                'message' => __('dashboard.medias.destroy'),
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.medias.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }
}
