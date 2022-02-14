<?php

namespace App\Models\Concerns\Target;

use App\Http\Requests\Target\StoreRequest;

/**
 * @property \App\Enum\Periodicity $periodicity
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \App\Entity\TargetAmount $amount
 * @property string|null $note
 * @property-read string|null $start_date_iso_format
 * @property-read string|null $end_date_iso_format
 * @property-read string|null $start_date_end_date_iso_format
 * @property-read string $name
 *
 * @see \App\Models\Target
 */
trait Attribute
{
    /**
     * Return "start_date_iso_format" attribute value.
     *
     * @return string|null
     */
    public function getStartDateIsoFormatAttribute(): ?string
    {
        if (is_null($this->start_date)) {
            return null;
        }

        return $this->start_date->isoFormat(static::DATE_FORMAT_ISO);
    }

    /**
     * Return "end_date_iso_format" attribute value.
     *
     * @return string|null
     */
    public function getEndDateIsoFormatAttribute(): ?string
    {
        if (is_null($this->end_date)) {
            return null;
        }

        return $this->end_date->isoFormat(static::DATE_FORMAT_ISO);
    }

    /**
     * Return "start_date_end_date_iso_format" attribute value.
     *
     * @return string|null
     */
    public function getStartDateEndDateIsoFormatAttribute(): ?string
    {
        if (is_null($this->start_date_iso_format) || is_null($this->end_date_iso_format)) {
            return null;
        }

        return $this->start_date_iso_format . StoreRequest::START_DATE_END_DATE_SEPARATOR . $this->end_date_iso_format;
    }

    /**
     * Return "name" attribute value.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return sprintf('%s (%s)', $this->periodicity->label, $this->start_date_end_date_iso_format);
    }
}
