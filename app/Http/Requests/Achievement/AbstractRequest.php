<?php

namespace App\Http\Requests\Achievement;

use App\Infrastructure\Foundation\Http\FormRequest;
use App\Models\Branch;
use App\Models\Achievement;
use App\Models\Event;
use App\Models\Target;
use App\Models\User;
use App\Rules\BranchExists;
use App\Rules\DateFormatLocaleISO;
use App\Rules\EventExists;
use App\Rules\TargetExists;
use App\Rules\UserExists;
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
            'target_id' => ['required', new TargetExists($this->user(), $this->getBranch())],
            'event_id' => ['sometimes', 'nullable', new EventExists($this->user(), $this->getBranch())],
            'achieved_date' => ['required', new DateFormatLocaleISO(Achievement::DATE_FORMAT_ISO)],
            'achieved_by' => [Rule::requiredIf(!$this->user()->isStaff()), new UserExists($this->user(), $this->getBranch())],
            'amount' => ['required', 'numeric', 'min:0'],
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
            'target_id' => trans('menu.target'),
            'event_id' => trans('menu.event'),
            'achieved_date' => trans('Achieved Date'),
            'achieved_by' => trans('Achieved By'),
            'amount' => trans('Amount'),
            'note' => trans('Note'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function validated($key = null, $default = null)
    {
        $validated = array_merge(parent::validated(), [
            'achieved_date' => DateFormatLocaleISO::parseDate(Achievement::DATE_FORMAT_ISO, $this->input('achieved_date')),
        ]);

        if (!is_null($key)) {
            return data_get($validated, $key, $default);
        }

        return $validated;
    }

    /**
     * Return target model based on the request.
     *
     * @param  string  $key
     * @return \App\Models\Target
     */
    public function getTarget(string $key = 'target_id'): Target
    {
        if ($this->user()->isAdmin()) {
            return Target::find($this->input($key));
        }

        return $this->user()->branch->targets()->find($this->input($key));
    }

    /**
     * Return event model based on the request.
     *
     * @param  string  $key
     * @return \App\Models\Event|null
     */
    public function getEvent(string $key = 'event_id'): ?Event
    {
        if ($this->user()->isAdmin()) {
            return Event::find($this->input($key));
        }

        return $this->user()->branch->events()->find($this->input($key));
    }

    /**
     * Return user model based on the request.
     *
     * @param  string  $key
     * @return \App\Models\User
     */
    public function getAchievedBy(string $key = 'achieved_by'): User
    {
        if ($this->user()->isAdmin()) {
            return User::find($this->input($key));
        }

        if ($this->user()->isManager()) {
            return $this->user()->branch->users()->find($this->input($key));
        }

        return $this->user();
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
