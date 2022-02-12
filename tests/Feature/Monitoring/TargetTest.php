<?php

use App\Models\Branch;
use App\Models\Target;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = pest_create_user(\App\Models\Role::ROLE_MANAGER);
});

it('has target index page', function () {
    actingAs($this->user)
        ->get(route('monitoring.target.index'))
        ->assertOk();
});

it('has target create page', function () {
    $response = actingAs($this->user)->get(route('monitoring.target.create'));

    if ($this->user->isAdmin() || $this->user->isManager()) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can store target', function () {
    $data = Target::factory()->rawForm(
        $branch = Branch::inRandomOrder()->first('id')
    );

    $response = actingAs($this->user)->post(route('monitoring.target.store'), $data);

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.target.index'));

        assertDatabaseHas(Target::class, Arr::except($data, 'start_date_end_date'));
    } elseif ($this->user->isStaff()) {
        $response->assertForbidden();
    } else {
        $response->assertSessionHasErrors('branch_id');
    }
});

it('has target show page', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->get(route('monitoring.target.show', $target));

    if ($this->user->isAdmin() ||
        ($this->user->isManager() && $this->user->branch->is($branch)) ||
        $this->user->is($target)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has target edit page', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->get(route('monitoring.target.edit', $target));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can update target', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $data = Target::factory()->rawForm(
        $this->user->isAdmin()
            ? Branch::inRandomOrder()->first('id')
            : $branch
    );

    $response = actingAs($this->user)->put(route('monitoring.target.update', $target), $data);

    $updatedTarget = Target::where(Arr::except($data, 'start_date_end_date'))->first();

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.target.edit', $updatedTarget));

        assertModelExists($updatedTarget);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy target', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->delete(route('monitoring.target.destroy', $target));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.target.index'));

        assertModelMissing($target);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy multiple target', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Target> $targets */
    $targets = Target::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->count(rand(1, 5))
        ->create();

    $response = actingAs($this->user)->delete(route('monitoring.target.destroy-multiple', [
        'checkbox' => $targets->pluck('id')->toArray(),
    ]));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.target.index'));

        foreach ($targets as $target) {
            assertModelMissing($target);
        }
    } else {
        $response->assertForbidden();
    }
});
