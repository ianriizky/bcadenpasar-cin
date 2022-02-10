<?php

namespace App\Models\Concerns\Achievement;

use App\Models\Achievement;
use App\Support\Models\Event as ModelEvent;
use Illuminate\Support\Facades\Auth;

/**
 * @see \App\Models\Achievement
 */
trait Event
{
    use ModelEvent;

    /**
     * Boot the trait on the model.
     *
     * @return void
     */
    protected static function bootEvent()
    {
        static::creating(function (Achievement $model) {
            if (Auth::check()) {
                $model->setAchievedByRelationValue(Auth::user());
            }
        });
    }
}
