<?php

namespace App\Infrastructure\Contracts\Auth;

interface MustVerifyUser
{
    /**
     * Determine if the user has verified their account.
     *
     * @return bool
     */
    public function hasVerifiedUser(): bool;

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markUserAsVerified(): bool;
}
