<?php

namespace App\Events;

use App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatingBelongsToCreatedBy
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  \App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy  $model
     * @return void
     */
    public function __construct(
        protected BelongsToCreatedBy $model
    ) {
        //
    }

    /**
     * Return HasCreatedByAttribute model instance.
     *
     * @return \App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy
     */
    public function getModel(): BelongsToCreatedBy
    {
        return $this->model;
    }
}
