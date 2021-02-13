<?php

namespace App\Models;

/**
 * @OA\Schema(required={"name", "email", "password"}, @OA\Xml(name="User"))
 */
class User extends \App\User
{
    /**
     * @OA\Property(example="User name")
     * @var string
     */
    public $name;

    /**
     * @OA\Property(example="User email")
     * @var string
     */
    public $email;

    /**
     * @OA\Property(example="User password")
     * @var string
     */
    //public $password;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
