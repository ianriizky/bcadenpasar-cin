<?php

namespace App\Http\Requests\Report;

use App\Infrastructure\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardPenutupanCin extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    protected $redirectRoute = 'report.dashboard-penutupan-cin.index';

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'period' => ['sometimes', 'nullable', 'date_format:Y-m'],
        ];
    }

    /**
     * Return "period" value from request.
     *
     * @param  string  $key
     * @return \Illuminate\Support\Carbon
     */
    public function getPeriod(string $key = 'period'): Carbon
    {
        return $this->date($key, 'Y-m') ?? Carbon::today();
    }

    /**
     * {@inheritDoc}
     */
    protected function failedValidation(Validator $validator)
    {
        Session::flash('alert', [
            'type' => 'alert-danger',
            'message' => $this->validator->errors()->first(),
        ]);

        parent::failedValidation($validator);
    }
}
