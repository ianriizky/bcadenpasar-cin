<?php

use App\Models\Branch;
use App\Models\Event;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has event index page', function () {
    $response = actingAs($this->user)->get(route('monitoring.event.index'));

    if ($this->user->can('viewAny', Event::class)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has event create page', function () {
    $response = actingAs($this->user)->get(route('monitoring.event.create'));

    if ($this->user->can('create', Event::class)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can store event', function () {
    $data = Event::factory()->rawForm(
        $branch = $this->user->branch
    );

    $response = actingAs($this->user)->post(route('monitoring.event.store'), $data);

    if ($this->user->can('create', Event::class)) {
        if (!$this->user->isAdmin() && !$this->user->branch->is($branch)) {
            $response->assertSessionHasErrors('branch_id');
        } else {
            $response->assertRedirect(route('monitoring.event.index'));

            assertDatabaseHas(Event::class, Arr::only($data, 'name'));
        }
    } else {
        $response->assertForbidden();
    }
});

it('has event show page', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for(Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->get(route('monitoring.event.show', $event));

    if ($this->user->can('view', $event)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has event edit page', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for(Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->get(route('monitoring.event.edit', $event));

    if ($this->user->can('update', $event)) {
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

    $updatedEvent = Event::where(Arr::except($data, 'date'))->first();

    if ($this->user->can('update', $event)) {
        $response->assertRedirect(route('monitoring.event.edit', $updatedEvent));

        assertModelExists($updatedEvent);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy event', function () {
    /** @var \App\Models\Event $event */
    $event = Event::factory()
        ->for(Branch::inRandomOrder()->first('id'))
        ->create();

    $response = actingAs($this->user)->delete(route('monitoring.event.destroy', $event));

    if ($this->user->can('delete', $event)) {
        $response->assertRedirect(route('monitoring.event.index'));

        assertModelMissing($event);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy multiple event', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Event> $events */
    $events = Event::factory()
        ->for(Branch::inRandomOrder()->first('id'))
        ->count(rand(1, 5))
        ->create();

    $response = actingAs($this->user)->delete(route('monitoring.event.destroy-multiple', [
        'checkbox' => $events->pluck('id')->toArray(),
    ]));

    foreach ($events as $event) {
        if ($this->user->can('delete', $event)) {
            $response->assertRedirect(route('monitoring.event.index'));

            assertModelMissing($event);
        } else {
            $response->assertForbidden();
        }
    }
});
