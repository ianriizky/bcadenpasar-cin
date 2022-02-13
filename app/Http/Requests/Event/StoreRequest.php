<?php

namespace App\Http\Requests\Event;

use App\Models\Event;

class StoreRequest extends AbstractRequest
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Models\Event
     */
    public function store(): Event
    {
        /** @var \App\Models\Event $event */
        $event = Event::make($this->validated());

        $event->setBranchRelationValue($this->getBranch())->save();

        return $event;
    }
}
