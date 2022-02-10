<?php

namespace App\Events;

use App\Infrastructure\Contracts\Model\HasCreatedByAttribute;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatingHasCreatedByAttribute
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  \App\Infrastructure\Contracts\Model\HasCreatedByAttribute  $model
     * @return void
     */
    public function __construct(
        protected HasCreatedByAttribute $model
    ) {
        //
    }

    /**
     * Return HasCreatedByAttribute model instance.
     *
     * @return \App\Infrastructure\Contracts\Model\HasCreatedByAttribute
     */
    public function getModel()
    {
        return $this->model;
    }
}
