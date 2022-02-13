<?php

use App\Models\Branch;
use App\Models\Event;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = pest_create_user(\App\Models\Role::ROLE_MANAGER);
});

it('has event index page', function () {
    actingAs($this->user)
        ->get(route('monitoring.event.index'))
        ->assertOk();
});

it('has event create page', function () {
    $response = actingAs($this->user)->get(route('monitoring.event.create'));

    if ($this->user->isAdmin() || $this->user->isManager()) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can store event', function () {
    $data = Event::factory()->rawForm(
        $branch = Branch::inRandomOrder()->first('id')
    );

    $response = actingAs($this->user)->post(route('monitoring.event.store'), $data);

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.event.index'));

        assertDatabaseHas(Event::class, Arr::except($data, 'start_date_end_date'));
    } elseif ($this->user->isStaff()) {
        $response->assertForbidden();
    } else {
        $response->assertSessionHasErrors('branch_id');
    }
});

it('has event show page', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->get(route('monitoring.event.show', $event));

    if ($this->user->isAdmin() ||
        ($this->user->isManager() && $this->user->branch->is($branch)) ||
        $this->user->is($event)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has event edit page', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->get(route('monitoring.event.edit', $event));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can update event', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $data = Event::factory()->rawForm(
        $this->user->isAdmin()
            ? Branch::inRandomOrder()->first('id')
            : $branch
    );

    $response = actingAs($this->user)->put(route('monitoring.event.update', $event), $data);

    $updatedEvent = Event::where(Arr::except($data, 'start_date_end_date'))->first();

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.event.edit', $updatedEvent));

        assertModelExists($updatedEvent);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy event', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->delete(route('monitoring.event.destroy', $event));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.event.index'));

        assertModelMissing($event);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy multiple event', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Event> $events */
    $events = Event::factory()
        ->for($branch = Branch::inRandomOrder()->first('id'))
        ->count(rand(1, 5))
        ->create();

    $response = actingAs($this->user)->delete(route('monitoring.event.destroy-multiple', [
        'checkbox' => $events->pluck('id')->toArray(),
    ]));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('monitoring.event.index'));

        foreach ($events as $event) {
            assertModelMissing($event);
        }
    } else {
        $response->assertForbidden();
    }
});
