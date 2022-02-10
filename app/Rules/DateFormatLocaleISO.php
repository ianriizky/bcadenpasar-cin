<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class DateFormatLocaleISO implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param  string  $format
     * @return void
     */
    public function __construct(
        protected string $format
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function passes($attribute, $value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        $date = $this->parseDate($this->format, $value);

        return $date && $date->isoFormat($this->format) == $value;
    }

    /**
     * {@inheritDoc}
     */
    public function message()
    {
        return trans('validation.date_format', ['format' => $this->format]);
    }

    /**
     * Create a Carbon instance from a specific ISO format and a value.
     *
     * @param  string  $format
     * @param  mixed  $value
     * @param  string|null  $locale
     * @return \Illuminate\Support\Carbon|false
     *
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public static function parseDate(string $format, $value, string $locale = null)
    {
        return Carbon::createFromLocaleIsoFormat('!' . $format, $locale ?? App::getLocale(), $value);
    }
}
