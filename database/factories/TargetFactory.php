<?php

namespace Database\Factories;

use App\Enum\Periodicity;
use App\Http\Requests\Target\StoreRequest;
use App\Models\Branch;
use App\Models\Target;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @see \App\Models\Branch
 */
class TargetFactory extends Factory
{
    /**
     * {@inheritDoc}
     */
    public function definition()
    {
        return [
            'periodicity' => $this->faker->randomElement(Periodicity::toValues()),
            'start_date' => $startDate = Carbon::parse($this->faker->dateTimeBetween('-1 year', '+1 year')),
            'end_date' => Carbon::parse($this->faker->dateTimeBetween($startDate, '+1 year')),
            'amount' => $this->faker->numberBetween(1, 100),
            'note' => $this->faker->word(),
        ];
    }

    /**
     * Get the raw attributes generated by the factory for form purposes.
     *
     * @param  \App\Models\Branch|null  $branch
     * @return array
     */
    public function rawForm(Branch $branch = null): array
    {
        $data = $this->raw();

        if ($branch) {
            $data['branch_id'] = $branch->getKey();
        }

        $data['start_date_end_date'] = $data['start_date']->isoFormat(Target::DATE_FORMAT_ISO) . StoreRequest::START_DATE_END_DATE_SEPARATOR . $data['end_date']->isoFormat(Target::DATE_FORMAT_ISO);

        unset($data['start_date'], $data['end_date']);

        return $data;
    }
}
