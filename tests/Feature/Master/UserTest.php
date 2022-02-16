<?php

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has user index page', function () {
    $response = actingAs($this->user)->get(route('master.user.index'));

    if ($this->user->can('viewAny', User::class)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has user create page', function () {
    $response = actingAs($this->user)->get(route('master.user.create'));

    if ($this->user->can('create', User::class)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can store user', function () {
    $data = User::factory()->rawForm(
        $branch = Branch::inRandomOrder()->first('id')
    );

    Event::fake();

    $response = actingAs($this->user)->post(route('master.user.store'), $data);

    if ($this->user->can('create', User::class)) {
        if (!$this->user->isAdmin() && !$this->user->branch->is($branch)) {
            $response->assertSessionHasErrors('branch_id');
        } else {
            $response->assertRedirect(route('master.user.index'));

            assertDatabaseHas(User::class, $data);

            Event::assertDispatched(Registered::class);
        }
    } else {
        $response->assertForbidden();
    }
});

it('has user show page', function () {
    $user = pest_create_random_manager_or_staff(
        Branch::inRandomOrder()->first('id')
    );

    $response = actingAs($this->user)->get(route('master.user.show', $user));

    if ($this->user->can('view', $user)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has user edit page', function () {
    $user = pest_create_random_manager_or_staff(
        Branch::inRandomOrder()->first('id')
    );

    $response = actingAs($this->user)->get(route('master.user.edit', $user));

    if ($this->user->can('update', $user)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can update user', function () {
    $user = pest_create_random_manager_or_staff(
        $branch = Branch::inRandomOrder()->first('id')
    );

    $data = User::factory()->rawForm(
        $this->user->isAdmin()
            ? Branch::inRandomOrder()->first('id')
            : $branch
    );

    $response = actingAs($this->user)->put(route('master.user.update', $user), $data);

    if ($this->user->can('update', $user)) {
        $response->assertRedirect(route('master.user.edit', User::firstWhere('username', $data['username'])));

        assertDatabaseHas(User::class, Arr::only($data, 'username'));
    } else {
        $response->assertForbidden();
    }
});

it('can destroy user', function () {
    $user = pest_create_random_manager_or_staff(
        Branch::inRandomOrder()->first('id')
    );

    $response = actingAs($this->user)->delete(route('master.user.destroy', $user));

    if ($this->user->can('delete', $user)) {
        $response->assertRedirect(route('master.user.index'));

        assertModelMissing($user);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy multiple user', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\User> $users */
    $users = User::factory()
        ->for(Branch::inRandomOrder()->first('id'))
        ->count(rand(1, 5))
        ->create()
        ->map(fn (User $user) => $user->syncRoles(Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF])));

    $response = actingAs($this->user)->delete(route('master.user.destroy-multiple', [
        'checkbox' => $users->pluck('id')->toArray(),
    ]));

    foreach ($users as $user) {
        if ($this->user->can('delete', $user)) {
            $response->assertRedirect(route('master.user.index'));

            assertModelMissing($user);
        } else {
            $response->assertForbidden();
        }
    }
});
