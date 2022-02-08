<?php

namespace App\Casts;

use App\Entity\TargetAmount as Entity;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TargetAmount implements Castable
{
    /**
     * {@inheritDoc}
     */
    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            /**
             * {@inheritDoc}
             *
             * @param  \App\Models\Target  $model
             * @param  string  $key
             * @param  int  $value
             * @param  array  $attributes
             * @return \App\Entity\TargetAmount
             */
            public function get($model, $key, $value, $attributes): Entity
            {
                return new Entity($model);
            }

            /**
             * {@inheritDoc}
             *
             * @param  \App\Models\Target  $model
             * @param  string  $key
             * @param  \App\Entity\TargetAmount|int  $value
             * @param  array  $attributes
             * @return int
             */
            public function set($model, $key, $value, $attributes): int
            {
                if ($value instanceof Entity) {
                    return $value->amountForPeriodicity($model->periodicity);
                }

                return $value;
            }
        };
    }
}
