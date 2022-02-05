<?php

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has master index page', function () {
    actingAs($this->admin)
        ->get(route('master.index'))
        ->assertOk();
});

#region branch
it('has branch index page', function () {
    actingAs($this->admin)
        ->get(route('master.branch.index'))
        ->assertOk();
});

it('has branch create page', function () {
    actingAs($this->admin)
        ->get(route('master.branch.create'))
        ->assertOk();
});

it('can store branch', function () {
    $data = Branch::factory()->raw();

    actingAs($this->admin)
        ->post(route('master.branch.store'), $data)
        ->assertRedirect(route('master.branch.index'));

    assertDatabaseHas(Branch::class, $data);
});

it('has branch show page', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    actingAs($this->admin)
        ->get(route('master.branch.show', $branch))
        ->assertOk();
});

it('has branch edit page', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    actingAs($this->admin)
        ->get(route('master.branch.edit', $branch))
        ->assertOk();
});

it('can update branch', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    $data = Branch::factory()->raw();

    actingAs($this->admin)
        ->put(route('master.branch.update', $branch), $data)
        ->assertRedirect(route('master.branch.edit', Branch::firstWhere('name', $data['name'])));

    assertDatabaseHas(Branch::class, $data);
});

it('can destroy branch', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    actingAs($this->admin)
        ->delete(route('master.branch.destroy', $branch))
        ->assertRedirect(route('master.branch.index'));

    assertDatabaseMissing(Branch::class, $branch->only('id'));
});

it('can destroy multiple branch', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Branch> $branches */
    $branches = Branch::factory()
        ->count(rand(1, 5))
        ->create();

    actingAs($this->admin)
        ->delete(route('master.branch.destroy-multiple', [
            'checkbox' => $branches->pluck('id')->toArray(),
        ]))
        ->assertRedirect(route('master.branch.index'));

    foreach ($branches as $branch) {
        assertDatabaseMissing(Branch::class, $branch->only('id'));
    }
});
#endregion branch

#region user
it('has user index page', function () {
    actingAs($this->admin)
        ->get(route('master.user.index'))
        ->assertOk();
});

it('has user create page', function () {
    actingAs($this->admin)
        ->get(route('master.user.create'))
        ->assertOk();
});

it('can store user', function () {
    $data = User::factory()->raw();
    $data = array_merge($data, [
        'branch_id' => Branch::value('id'),
        'password_confirmation' => $data['password'],
        'role' => Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF]),
    ]);

    Event::fake();

    actingAs($this->admin)
        ->post(route('master.user.store'), $data)
        ->assertRedirect(route('master.user.index'));

    assertDatabaseHas(User::class, Arr::only($data, 'username'));
});

it('has user show page', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()
        ->forBranch()
        ->create()
        ->syncRoles(Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF]));

    actingAs($this->admin)
        ->get(route('master.user.show', $user))
        ->assertOk();
});

it('has user edit page', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()
        ->forBranch()
        ->create()
        ->syncRoles(Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF]));

    actingAs($this->admin)
        ->get(route('master.user.edit', $user))
        ->assertOk();
});

it('can update user', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()
        ->forBranch()
        ->create()
        ->syncRoles(Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF]));

    $data = User::factory()->raw();
    $data = array_merge($data, [
        'branch_id' => Branch::value('id'),
        'password_confirmation' => $data['password'],
        'role' => Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF]),
    ]);

    Event::fake();

    actingAs($this->admin)
        ->put(route('master.user.update', $user), $data)
        ->assertRedirect(route('master.user.edit', User::firstWhere('username', $data['username'])));

    assertDatabaseHas(User::class, Arr::only($data, 'username'));
});

it('can destroy user', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()
        ->forBranch()
        ->create()
        ->syncRoles(Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF]));

    actingAs($this->admin)
        ->delete(route('master.user.destroy', $user))
        ->assertRedirect(route('master.user.index'));

    assertDatabaseMissing(User::class, $user->only('id'));
});

it('can destroy multiple user', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\User> $users */
    $users = User::factory()
        ->forBranch()
        ->count(rand(1, 5))
        ->create()
        ->map(fn (User $user) => $user->syncRoles(Arr::random([Role::ROLE_ADMIN, Role::ROLE_STAFF])));

    actingAs($this->admin)
        ->delete(route('master.user.destroy-multiple', [
            'checkbox' => $users->pluck('id')->toArray(),
        ]))
        ->assertRedirect(route('master.user.index'));

    foreach ($users as $user) {
        assertDatabaseMissing(User::class, $user->only('id'));
    }
});
#endregion user
