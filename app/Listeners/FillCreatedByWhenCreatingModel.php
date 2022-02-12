<?php

namespace App\Listeners;

use App\Events\CreatingBelongsToCreatedBy;
use Illuminate\Support\Facades\Auth;

class FillCreatedByWhenCreatingModel
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CreatingBelongsToCreatedBy  $event
     * @return void
     */
    public function handle(CreatingBelongsToCreatedBy $event)
    {
        if (Auth::check()) {
            $event->getModel()->setCreatedByRelationValue(Auth::user());
        }
    }
}
