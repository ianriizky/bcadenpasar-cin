<?php

namespace App\Http\Requests\Achievement;

use App\Models\Achievement;

class UpdateRequest extends AbstractRequest
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \App\Models\Achievement
     */
    public function update(Achievement $achievement): Achievement
    {
        $achievement = $achievement->fill($this->validated());

        $achievement
            ->setTargetRelationValue($this->getTarget())
            ->setAchievedByRelationValue($this->getAchievedBy());

        if ($this->getEvent()) {
            $achievement->setEventRelationValue($this->getEvent());
        } else {
            $achievement->event()->dissociate();
        }

        $achievement->save();

        return $achievement;
    }
}
