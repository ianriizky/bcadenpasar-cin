<?php

use App\Models\Target;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
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
        ->get(route('master.target.index'))
        ->assertOk();
});

it('has target create page', function () {
    actingAs($this->admin)
        ->get(route('master.target.create'))
        ->assertOk();
});

it('can store target', function () {
    $data = Target::factory()->raw();

    actingAs($this->admin)
        ->post(route('master.target.store'), $data)
        ->assertRedirect(route('master.target.index'));

    assertDatabaseHas(Target::class, $data);
});

it('has target show page', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()->create();

    actingAs($this->admin)
        ->get(route('master.target.show', $target))
        ->assertOk();
});

it('has target edit page', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()->create();

    actingAs($this->admin)
        ->get(route('master.target.edit', $target))
        ->assertOk();
});

it('can update target', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()->create();

    $data = Target::factory()->raw();

    actingAs($this->admin)
        ->put(route('master.target.update', $target), $data)
        ->assertRedirect(route('master.target.edit', Target::firstWhere('name', $data['name'])));

    assertDatabaseHas(Target::class, $data);
});

it('can destroy target', function () {
    /** @var \App\Models\Target $target */
    $target = Target::factory()->create();

    actingAs($this->admin)
        ->delete(route('master.target.destroy', $target))
        ->assertRedirect(route('master.target.index'));

    assertModelMissing($target);
});

it('can destroy multiple target', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Target> $targetes */
    $targetes = Target::factory()
        ->count(rand(1, 5))
        ->create();

    actingAs($this->admin)
        ->delete(route('master.target.destroy-multiple', [
            'checkbox' => $targetes->pluck('id')->toArray(),
        ]))
        ->assertRedirect(route('master.target.index'));

    foreach ($targetes as $target) {
        assertModelMissing($target);
    }
});
#endregion target
