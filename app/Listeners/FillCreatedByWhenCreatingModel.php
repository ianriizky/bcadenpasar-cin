<?php

namespace App\Listeners;

use App\Infrastructure\Contracts\Model\HasCreatedByAttribute;
use Illuminate\Support\Facades\Auth;

class FillCreatedByWhenCreatingModel
{
    /**
     * Handle the event.
     *
     * @param  \App\Infrastructure\Contracts\Model\HasCreatedByAttribute  $model
     * @return void
     */
    public function handle(HasCreatedByAttribute $model)
    {
        if (Auth::check()) {
            $model->setCreatedByRelationValue(Auth::user());
        }
    }
}
