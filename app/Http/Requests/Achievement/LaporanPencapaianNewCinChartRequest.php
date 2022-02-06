<?php

namespace App\Http\Requests\Achievement;

use App\Enum\Periodicity;
use App\Infrastructure\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Http\Requests\TransformsEnums;
use Spatie\Enum\Laravel\Rules\EnumRule;

/**
 * @property \App\Enum\Periodicity $periodicity
 */
class LaporanPencapaianNewCinChartRequest extends FormRequest
{
    use TransformsEnums;

    /**
     * {@inheritDoc}
     */
    public function authorize()
    {
        return !is_null($this->user());
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'start_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'periodicity' => ['sometimes', 'nullable', new EnumRule(Periodicity::class)],
        ];
    }

    /**
     * List of transformed enum from request.
     *
     * @return array
     */
    public function enums(): array
    {
        return [
            'periodicity' => Periodicity::class,
        ];
    }
}
