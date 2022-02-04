<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->forBranch()->create();

    $this->user->syncRoles(Role::ROLE_ADMIN);
});

it('has profile edit page', function () {
    actingAs($this->user)
        ->get(route('profile.edit'))
        ->assertOk();
});

it('can update profile', function () {
    $data = User::factory()->raw();
    $data = array_merge($data, [
        'password_confirmation' => $data['password'],
    ]);

    actingAs($this->user)
        ->put(route('profile.edit'), $data)
        ->assertRedirect(route('profile.edit'));

    assertDatabaseHas(User::class, Arr::only($data, 'username'));
});
