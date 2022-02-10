<?php

namespace App\Models\Concerns\Achievement;

/**
 * @property \Illuminate\Support\Carbon $achieved_date
 * @property int $amount
 * @property string|null $note
 * @property-read string $achieved_date_iso_format
 *
 * @see \App\Models\Achievement
 */
trait Attribute
{
    /**
     * Return "achieved_date_iso_format" attribute value.
     *
     * @return string
     */
    public function getAchievedDateIsoFormatAttribute(): string
    {
        return $this->achieved_date->isoFormat(static::DATE_FORMAT_ISO);
    }
}
