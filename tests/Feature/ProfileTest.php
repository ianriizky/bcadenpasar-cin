<?php

use App\Models\User;
use Illuminate\Support\Arr;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has profile edit page', function () {
    actingAs($this->admin)
        ->get(route('profile.edit'))
        ->assertOk();
});

it('can update profile', function () {
    $data = User::factory()->raw();
    $data = array_merge($data, [
        'password_confirmation' => $data['password'],
    ]);

    actingAs($this->admin)
        ->put(route('profile.edit'), $data)
        ->assertRedirect(route('profile.edit'));

    assertDatabaseHas(User::class, Arr::only($data, 'username'));
});
