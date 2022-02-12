<?php

namespace App\Support\Models;

use App\Infrastructure\Contracts\Auth\BypassVerifyEmail;
use App\Support\Models\Event as ModelEvent;

trait BypassEmailVerification
{
    use ModelEvent;

    /**
     * Boot the trait on the model.
     *
     * @return void
     */
    protected static function bootBypassEmailVerification()
    {
        static::creating(function ($model) {
            if ($model instanceof BypassVerifyEmail) {
                $model->bypassEmailVerification();
            }
        });
    }
}
