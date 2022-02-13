<?php

namespace App\Http\Requests\Event;

use App\Models\Event;

class UpdateRequest extends AbstractRequest
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Event  $event
     * @return \App\Models\Event
     */
    public function update(Event $event): Event
    {
        $event = $event->fill($this->validated())->setBranchRelationValue(
            $this->getBranch()
        );

        $event->save();

        return $event;
    }
}
