<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends CustomController
{
    /**
     * @OA\Get(
     *     path="/comments",
     *     tags={"Comments"},
     *     operationId="index",
     *     summary="List all comments",
     *     description="Get comments list",
     *      security={{"bearer_token":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CommentResource")
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
        return new CommentResource(Comment::paginate(5));
    }

    /**
     * @OA\Post(
     *     path="/comments",
     *     tags={"Comments"},
     *     operationId="store",
     *     summary="Add a new comment to the blog",
     *     description="Create a comment and return that",
     *      security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         description="Comment object that needs to be added to the blog",
     *         required=true,
     *             @OA\JsonContent(ref="#/components/schemas/StoreCommentRequest")
     *     ),
     *     @OA\RequestBody(
     *         description="Comment object that needs to be added to the blog",
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
    public function store(StoreCommentRequest $request)
    {
        try {

            $validated = $request->validated();

            $comment = Comment::createComment([
                'user_id' => auth()->id(),
                'post_id' => $validated['post_id'],
                'content' => $validated['content']
            ]);

            return response()->json([
                'message' => __('dashboard.comments.created'),
                'response' => $comment->toArray()
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.comments.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/comments/{id}",
     *      operationId="show",
     *      tags={"Comments"},
     *      summary="Get comment information",
     *      description="Returns comment data",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
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
    public function show(Comment $comment)
    {
        try {

            return response()->json([
                'message' => __('dashboard.comments.show'),
                'response' => $comment
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.comments.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Put(
     *      path="/comments/{id}",
     *      operationId="update",
     *      tags={"Comments"},
     *      summary="Update existing comment",
     *      description="Returns updated comment data",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
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
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
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
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        try {

            $validated = $request->validated();

            $comment->updateComment([
                'content' => $validated['content']
            ]);

            return response()->json([
                'message' => __('dashboard.comments.updated'),
                'response' => $comment->toArray()
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.comments.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/comments/{id}",
     *      operationId="destroy",
     *      tags={"Comments"},
     *      summary="Delete existing comment",
     *      description="Deletes a record and returns no content",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
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
    public function destroy(Comment $comment)
    {
        try {

            $comment->deleteComment();

            return response()->json([
                'message' => __('dashboard.comments.destroy'),
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.comments.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }
}
