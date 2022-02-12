<?php

use App\Models\User;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->admin = pest_create_random_user();
});

it('has profile edit page', function () {
    actingAs($this->admin)
        ->get(route('profile.edit'))
        ->assertOk();
});

it('can update profile', function () {
    $data = Arr::except(User::factory()->rawForm(), 'role');

    actingAs($this->admin)
        ->put(route('profile.edit'), $data)
        ->assertRedirect(route('profile.edit'));

    assertDatabaseHas(User::class, Arr::only($data, 'username'));
});
