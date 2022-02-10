<?php

namespace App\Models\Concerns\Target;

/**
 * @property \App\Enum\Periodicity $periodicity
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \App\Entity\TargetAmount $amount
 * @property string|null $note
 * @property-read string $start_date_iso_format
 * @property-read string $end_date_iso_format
 *
 * @see \App\Models\Target
 */
trait Attribute
{
    /**
     * Return "start_date_iso_format" attribute value.
     *
     * @return string
     */
    public function getStartDateIsoFormatAttribute(): string
    {
        return $this->start_date->isoFormat(static::DATE_FORMAT_ISO);
    }

    /**
     * Return "end_date_iso_format" attribute value.
     *
     * @return string
     */
    public function getEndDateIsoFormatAttribute(): string
    {
        return $this->end_date->isoFormat(static::DATE_FORMAT_ISO);
    }
}
