<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends CustomController
{
    /**
     * @OA\Get(
     *     path="/posts",
     *     tags={"Posts"},
     *     operationId="index",
     *     summary="List all posts",
     *     description="Get posts list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostResource")
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
        return new PostResource(Post::all());
    }

    /**
     * @OA\Post(
     *     path="/posts",
     *     tags={"Posts"},
     *     operationId="store",
     *     summary="Add a new Post to the blog",
     *     description="Create a Post and return that",
     *     @OA\RequestBody(
     *         description="Post object that needs to be added to the blog",
     *         required=true,
     *             @OA\JsonContent(ref="#/components/schemas/StorePostRequest")
     *     ),
     *     @OA\RequestBody(
     *         description="Post object that needs to be added to the blog",
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
    public function store(StorePostRequest $request)
    {
        try {

            $validated = $request->validated();

            DB::beginTransaction();

            $user = Post::create([
                'user_id' => auth()->id(),
                'category_id' => $validated['category_id'],
                'title' => $validated['title'],
                'description' => $validated['description']
            ]);

            DB::commit();

            return response()->json([
                'message' => __('dashboard.posts.created'),
                'response' => $user->toArray()
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.posts.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/posts/{id}",
     *      operationId="show",
     *      tags={"Posts"},
     *      summary="Get Post information",
     *      description="Returns Post data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
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
    public function show(Post $post)
    {
        try {

            return response()->json([
                'message' => __('dashboard.posts.show'),
                'response' => $post
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.posts.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Put(
     *      path="/posts/{id}",
     *      operationId="update",
     *      tags={"Posts"},
     *      summary="Update existing Post",
     *      description="Returns updated Post data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
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
     *          @OA\JsonContent(ref="#/components/schemas/Post")
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
    public function update(UpdatePostRequest $request, Post $post)
    {
        try {

            $validated = $request->validated();

            DB::beginTransaction();

            $post->update([
                'category_id' => $validated['category_id'],
                'title' => $validated['title'],
                'description' => $validated['description']
            ]);

            DB::commit();

            return response()->json([
                'message' => __('dashboard.posts.updated'),
                'response' => $post->toArray()
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.posts.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/posts/{id}",
     *      operationId="destroy",
     *      tags={"Posts"},
     *      summary="Delete existing Post",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
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
    public function destroy(Post $post)
    {
        try {

            DB::beginTransaction();

            $post->delete();

            DB::commit();

            return response()->json([
                'message' => __('dashboard.posts.destroy'),
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.posts.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }
}
