<?php

namespace App\Http\Requests\Achievement;

use App\Models\Achievement;

class StoreRequest extends AbstractRequest
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Models\Achievement
     */
    public function store(): Achievement
    {
        /** @var \App\Models\Achievement $achievement */
        $achievement = Achievement::make($this->validated());

        $achievement
            ->setTargetRelationValue($this->getTarget())
            ->setAchievedByRelationValue($this->getAchievedBy());

        if ($this->getEvent()) {
            $achievement->setEventRelationValue($this->getEvent());
        }

        $achievement->save();

        return $achievement;
    }
}
