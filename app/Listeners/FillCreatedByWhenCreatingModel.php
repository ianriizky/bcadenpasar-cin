<?php

namespace App\Listeners;

use App\Events\CreatingHasCreatedByAttribute;
use Illuminate\Support\Facades\Auth;

class FillCreatedByWhenCreatingModel
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CreatingHasCreatedByAttribute  $event
     * @return void
     */
    public function handle(CreatingHasCreatedByAttribute $event)
    {
        if (Auth::check()) {
            $event->getModel()->setCreatedByRelationValue(Auth::user());
        }
    }
}
