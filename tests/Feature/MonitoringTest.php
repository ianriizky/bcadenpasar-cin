<?php

use App\Models\Branch;
use App\Models\Event;
use App\Models\Target;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = pest_create_manager_from_existed_branch();
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

    $response->assertRedirect(route('monitoring.target.edit', $updatedTarget));

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

#region event
it('has event index page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.event.index'))
        ->assertOk();
});

it('has event create page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.event.create'))
        ->assertOk();
});

it('can store event', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::all('id')->random();

    $data = Event::factory()->rawForm($branch);

    actingAs($this->admin)
        ->post(route('monitoring.event.store'), $data)
        ->assertRedirect(route('monitoring.event.index'));

    assertDatabaseHas(Event::class, Arr::except($data, 'start_date_end_date'));
});

it('has event show page', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->forBranch()
        ->create();

    actingAs($this->admin)
        ->get(route('monitoring.event.show', $event))
        ->assertOk();
});

it('has event edit page', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->forBranch()
        ->create();

    actingAs($this->admin)
        ->get(route('monitoring.event.edit', $event))
        ->assertOk();
});

it('can update event', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->forBranch()
        ->create();

    /** @var \App\Models\Branch $branch */
    $branch = Branch::all('id')->random();

    $data = Event::factory()->rawForm($branch);

    $response = actingAs($this->admin)
        ->put(route('monitoring.event.update', $event), $data);

    $updatedEvent = Event::where(Arr::except($data, 'start_date_end_date'))->first();

    $response->assertRedirect(route('monitoring.event.edit', $updatedEvent));

    assertModelExists($updatedEvent);
});

it('can destroy event', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->forBranch()
        ->create();

    actingAs($this->admin)
        ->delete(route('monitoring.event.destroy', $event))
        ->assertRedirect(route('monitoring.event.index'));

    assertModelMissing($event);
});

it('can destroy multiple event', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Event> $events */
    $events = Event::factory()
        ->forBranch()
        ->count(rand(1, 5))
        ->create();

    actingAs($this->admin)
        ->delete(route('monitoring.event.destroy-multiple', [
            'checkbox' => $events->pluck('id')->toArray(),
        ]))
        ->assertRedirect(route('monitoring.event.index'));

    foreach ($events as $event) {
        assertModelMissing($event);
    }
});
#endregion event
