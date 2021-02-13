<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserAclRequest;
use App\Http\Requests\Users\UserEmailRequest;
use App\Http\Requests\Users\UserPasswordRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Resources\Users as UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends CustomController
{
    /*
    |--------------------------------------------------------------------------
    | API Users Route
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Display a all items of the resource.
     *
     * @return UserResource
     */
    public function index()
    {
        return new UserResource(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->accessToken = $user->createToken('app-token')->plainTextToken;

        DB::commit();

        return response()->json([
            'message' => __('dashboard.users.created'),
            'response' => $user->toArray()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        $user = User::find($id);
        $user->update([
            'name' => $validated['name']
        ]);

        DB::commit();

        return response()->json([
            'message' => __('dashboard.users.updated'),
            'response' => $user->toArray()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserAclRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function acl(UserAclRequest $request, $id)
    {
        DB::beginTransaction();

        $user = User::find($id);

        // prevent authenticate user lost onwer role
        if(auth()->id() === intval($id) && $user->hasRole('owner')) {

            return response()->json([
                'message' => __('dashboard.users.acl_sync_failed'),
            ], 200);
        }

        DB::commit();

        return response()->json([
            'message' => __('dashboard.users.acl_sync'),
            'response' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserPasswordRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(UserPasswordRequest $request, $id)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        $user = User::find($id);
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        DB::commit();

        return response()->json([
            'message' => __('dashboard.users.password_updated'),
            'response' => $user->toArray()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserEmailRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeEmail(UserEmailRequest $request, $id)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        $user = User::find($id);
        $user->update([
            'email' => $validated['email']
        ]);

        DB::commit();

        return response()->json([
            'message' => __('dashboard.users.email_updated'),
            'response' => $user->toArray()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {

            return response()->json([
                'message' => __('dashboard.users.show_failed'),
                'response' => $user
            ], 400);
        }

        return response()->json([
            'message' => __('dashboard.users.show'),
            'response' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        $model = User::where(['id' => $id]);

        if (!$model->exists()) {

            return response()->json([
                'message' => __('dashboard.users.destroy_failed')
            ], 400);
        }

        $model->delete();

        DB::commit();

        return response()->json([
            'message' => __('dashboard.users.destroy'),
        ], 200);
    }
}
