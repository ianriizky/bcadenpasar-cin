<?php

namespace App\Models\Concerns\Event;

/**
 * @property string $name
 * @property \Illuminate\Support\Carbon $date
 * @property string $location
 * @property string|null $note
 * @property string $date_iso_format
 *
 * @see \App\Models\Event
 */
trait Attribute
{
    /**
     * Return "date_iso_format" attribute value.
     *
     * @return string
     */
    public function getDateIsoFormatAttribute(): string
    {
        return $this->date->isoFormat(static::DATE_FORMAT_ISO);
    }
}
