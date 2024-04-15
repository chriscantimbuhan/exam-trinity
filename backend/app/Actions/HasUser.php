<?php

namespace App\Actions;

use App\Models\User;

interface HasUser
{
    /**
     * Set the user of the action.
     * 
     * @param \App\Models\User
     * @return static
     */
    public function setUser(User $user);

    /**
     * Get the user of the action.
     * 
     * @return \App\Models\User|null
     */
    public function getUser();

    /**
     * Check if a user was specified on the action.
     * 
     * @return bool
     */
    public function hasUser();
}
