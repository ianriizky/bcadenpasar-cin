<?php

namespace App\Http\Requests\Event;

use App\Infrastructure\Foundation\Http\FormRequest;
use App\Models\Branch;
use App\Models\Event;
use App\Rules\BranchExists;
use App\Rules\DateFormatLocaleISO;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

abstract class AbstractRequest extends FormRequest
{
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
            'branch_id' => [Rule::requiredIf($this->user()->isAdmin()), new BranchExists($this->user())],
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', new DateFormatLocaleISO(Event::DATE_FORMAT_ISO)],
            'location' => ['required', 'string'],
            'note' => ['sometimes', 'nullable', 'string'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributes()
    {
        return [
            'branch_id' => trans('menu.branch'),
            'name' => trans('Name'),
            'date' => trans('Date'),
            'location' => trans('Location'),
            'note' => trans('Note'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function validated($key = null, $default = null)
    {
        $validated = array_merge(parent::validated(), [
            'date' => DateFormatLocaleISO::parseDate(Event::DATE_FORMAT_ISO, $this->input('date'))->startOfDay(),
        ]);

        if (!is_null($key)) {
            return data_get($validated, $key, $default);
        }

        return $validated;
    }

    /**
     * Return branch model based on the request.
     *
     * @param  string  $key
     * @return \App\Models\Branch
     */
    public function getBranch(string $key = 'branch_id'): Branch
    {
        if ($this->user()->isAdmin()) {
            return Branch::find($this->input($key));
        }

        return $this->user()->branch;
    }
}
