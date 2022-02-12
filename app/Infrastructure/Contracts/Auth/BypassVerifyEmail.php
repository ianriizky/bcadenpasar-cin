<?php

namespace App\Infrastructure\Contracts\Auth;

use Illuminate\Support\Carbon;

interface BypassVerifyEmail
{
    /**
     * Bypass email verification process by fill the "email_verified_at" field.
     *
     * @param  \Illuminate\Support\Carbon|null  $date
     * @return $this
     */
    public function bypassEmailVerification(Carbon $date = null);
}
