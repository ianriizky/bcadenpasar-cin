<?php

namespace App\Http\Requests\Target;

use App\Enum\Periodicity;
use App\Infrastructure\Foundation\Http\FormRequest;
use App\Models\Branch;
use App\Models\Target;
use App\Rules\DateFormatLocaleISO;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Http\Requests\TransformsEnums;
use Spatie\Enum\Laravel\Rules\EnumRule;

/**
 * @property \App\Enum\Periodicity $periodicity
 */
abstract class AbstractRequest extends FormRequest
{
    use TransformsEnums;

    /**
     * Separator value for "start_date_end_date" field.
     *
     * @var string
     */
    const START_DATE_END_DATE_SEPARATOR = ' – ';

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
            'branch_id' => [Rule::requiredIf($this->user()->isAdmin()), Rule::exists(Branch::class, 'id')],
            'periodicity' => ['required', new EnumRule(Periodicity::class)],
            'start_date_end_date' => ['required', function ($attribute, $value, $fail) {
                [$start_date, $end_date] = $this->splitStartEndDate($this->input('start_date_end_date'));

                $validator = Validator::make(compact('start_date', 'end_date'), [
                    'start_date' => ['required', new DateFormatLocaleISO(Target::DATE_FORMAT_ISO)],
                    'end_date' => ['required', new DateFormatLocaleISO(Target::DATE_FORMAT_ISO)],
                ]);

                if ($validator->fails()) {
                    $fail($validator->getMessageBag()->first());
                }
            }],
            'amount' => 'required|numeric|min:0',
            'note' => 'sometimes|nullable|string',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributes()
    {
        return [
            'branch_id' => trans('menu.branch'),
            'periodicity' => trans('Periodicity'),
            'start_date_end_date' => trans('Start Date') . ' & ' . trans('End Date'),
            'amount' => trans('Amount'),
            'note' => trans('Note'),
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

    /**
     * {@inheritDoc}
     */
    public function passedValidation()
    {
        $this->transformEnums($this->enums());

        [$start_date, $end_date] = $this->splitStartEndDate($this->input('start_date_end_date'));

        $this->merge(compact('start_date', 'end_date'));

        $this->offsetUnset('start_date_end_date');
    }

    /**
     * {@inheritDoc}
     */
    public function validated($key = null, $default = null)
    {
        $validated = collect(parent::validated())
            ->map(fn ($value, $key) => $this->input($key))
            ->forget('start_date_end_date')
            ->merge([
                'start_date' => DateFormatLocaleISO::parseDate(Target::DATE_FORMAT_ISO, $this->input('start_date'))->startOfDay(),
                'end_date' => DateFormatLocaleISO::parseDate(Target::DATE_FORMAT_ISO, $this->input('end_date'))->endOfDay(),
            ])
            ->toArray();

        if (!is_null($key)) {
            return data_get($validated, $key, $default);
        }

        return $validated;
    }

    /**
     * Return splitted start_date and end_date based on the given value.
     *
     * @param  string  $value
     * @return array
     */
    protected static function splitStartEndDate(string $value): array
    {
        return array_pad(explode(static::START_DATE_END_DATE_SEPARATOR, $value), 2, null);
    }

    /**
     * Return branch model based on the request.
     *
     * @param  string  $key
     * @return \App\Models\Branch
     */
    public function getBranch(string $key = 'branch_id'): Branch
    {
        if ($this->user()->isStaff()) {
            return $this->user()->branch;
        }

        return Branch::find($this->input($key));
    }
}
