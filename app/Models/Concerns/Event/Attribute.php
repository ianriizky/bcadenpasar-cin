<?php

namespace App\Models\Concerns\Event;

/**
 * @property string $name
 * @property \Illuminate\Support\Carbon $date
 * @property string $location
 * @property string|null $note
 * @property string|null $date_iso_format
 * @property-read string $name_with_date_iso_format
 *
 * @see \App\Models\Event
 */
trait Attribute
{
    /**
     * Return "date_iso_format" attribute value.
     *
     * @return string|null
     */
    public function getDateIsoFormatAttribute(): ?string
    {
        if (is_null($this->date)) {
            return null;
        }

        return $this->date->isoFormat(static::DATE_FORMAT_ISO);
    }

    /**
     * Return "name_with_date_iso_format" attribute value.
     *
     * @return string
     */
    public function getNameWithDateIsoFormatAttribute(): string
    {
        return sprintf('%s (%s)', $this->name, $this->date_iso_format);
    }
}
