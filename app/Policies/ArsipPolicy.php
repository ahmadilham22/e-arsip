<?php

namespace App\Policies;

use App\Models\{User, Arsip};

class ArsipPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct(User $user, Arsip $arsip)
    {
        return $user->id == $arsip->user_id;
    }
}
