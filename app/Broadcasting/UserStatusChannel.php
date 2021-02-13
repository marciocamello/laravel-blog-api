<?php

namespace App\Broadcasting;

use App\Models\User;

class UserStatusChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @return array
     */
    public function join(User $user)
    {
        if (auth()->check()) {
            return $user->toArray();
        }
    }
}
