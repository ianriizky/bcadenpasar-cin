<?php

use App\Models\Branch;
use App\Models\Target;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has monitoring index page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.index'))
        ->assertOk();
});

#region target
it('has target index page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.target.index'))
        ->assertOk();
});

it('has target create page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.target.create'))
        ->assertOk();
});

it('can store target', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::all('id')->random();

    $data = Target::factory()->rawForm($branch);

    actingAs($this->admin)
        ->post(route('monitoring.target.store'), $data)
        ->assertRedirect(route('monitoring.target.index'));

    assertDatabaseHas(Target::class, Arr::except($data, 'start_date_end_date'));
});

it('has target show page', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->forBranch()
        ->create();

    actingAs($this->admin)
        ->get(route('monitoring.target.show', $target))
        ->assertOk();
});

it('has target edit page', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->forBranch()
        ->create();

    actingAs($this->admin)
        ->get(route('monitoring.target.edit', $target))
        ->assertOk();
});

it('can update target', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->forBranch()
        ->create();

    /** @var \App\Models\Branch $branch */
    $branch = Branch::all('id')->random();

    $data = Target::factory()->rawForm($branch);

    $response = actingAs($this->admin)
        ->put(route('monitoring.target.update', $target), $data);

    $updatedTarget = Target::where(Arr::except($data, 'start_date_end_date'))->first();

    $response->assertRedirect(route('monitoring.target.edit', ['target' => $updatedTarget]));

    assertModelExists($updatedTarget);
});

it('can destroy target', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()
        ->forBranch()
        ->create();

    actingAs($this->admin)
        ->delete(route('monitoring.target.destroy', $target))
        ->assertRedirect(route('monitoring.target.index'));

    assertModelMissing($target);
});

it('can destroy multiple target', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Target> $targets */
    $targets = Target::factory()
        ->forBranch()
        ->count(rand(1, 5))
        ->create();

    actingAs($this->admin)
        ->delete(route('monitoring.target.destroy-multiple', [
            'checkbox' => $targets->pluck('id')->toArray(),
        ]))
        ->assertRedirect(route('monitoring.target.index'));

    foreach ($targets as $target) {
        assertModelMissing($target);
    }
});
#endregion target
