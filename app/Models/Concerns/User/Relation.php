<?php

namespace App\Models\Concerns\User;

use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $company_id Foreign key of \App\Models\Company.
 * @property-read \App\Models\Company $company
 *
 * @see \App\Models\User
 */
trait Relation
{
    /**
     * Define an inverse one-to-one or many relationship with \App\Models\Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Return \App\Models\Company model relation value.
     *
     * @return \App\Models\Company
     */
    public function getCompanyRelationValue(): Company
    {
        return $this->getRelationValue('company');
    }

    /**
     * Set \App\Models\Company model relation value.
     *
     * @param  \App\Models\Company  $company
     * @return $this
     */
    public function setCompanyRelationValue(Company $company)
    {
        $this->company()->associate($company);

        return $this;
    }
}
