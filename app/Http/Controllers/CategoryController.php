<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends CustomController
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"Categories"},
     *     operationId="index",
     *     summary="List all categories",
     *     description="Get categories list",
     *      security={{"bearer_token":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
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
        return new CategoryResource(Category::all());
    }

    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"Categories"},
     *     operationId="store",
     *     summary="Add a new category to the blog",
     *     description="Create a category and return that",
     *      security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         description="Category object that needs to be added to the blog",
     *         required=true,
     *             @OA\JsonContent(ref="#/components/schemas/StoreCategoryRequest")
     *     ),
     *     @OA\RequestBody(
     *         description="Category object that needs to be added to the blog",
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
    public function store(StoreCategoryRequest $request)
    {
        try {

            $validated = $request->validated();

            DB::beginTransaction();

            $user = Category::create([
                'name' => $validated['name'],
                'parent_id' => $validated['parent_id'] ?? 0
            ]);

            DB::commit();

            return response()->json([
                'message' => __('dashboard.categories.created'),
                'response' => $user->toArray()
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.categories.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/categories/{id}",
     *      operationId="show",
     *      tags={"Categories"},
     *      summary="Get category information",
     *      description="Returns category data",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function show(Category $category)
    {
        try {

            return response()->json([
                'message' => __('dashboard.categories.show'),
                'response' => $category
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => __('dashboard.categories.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Put(
     *      path="/categories/{id}",
     *      operationId="update",
     *      tags={"Categories"},
     *      summary="Update existing category",
     *      description="Returns updated category data",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {

            $validated = $request->validated();

            DB::beginTransaction();

            $category->update([
                'name' => $validated['name']
            ]);

            DB::commit();

            return response()->json([
                'message' => __('dashboard.categories.updated'),
                'response' => $category->toArray()
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.categories.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/categories/{id}",
     *      operationId="destroy",
     *      tags={"Categories"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
    public function destroy(Category $category)
    {
        try {

            DB::beginTransaction();

            $category->delete();

            DB::commit();

            return response()->json([
                'message' => __('dashboard.categories.destroy'),
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('dashboard.categories.error'),
                'error' => $e->getMessage()
            ], 200);
        }
    }
}
