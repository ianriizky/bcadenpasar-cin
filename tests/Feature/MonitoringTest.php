<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->forBranch()->create();
});

it('has monitoring index page', function () {
    actingAs($this->user)
        ->get(route('monitoring.index'))
        ->assertOk();
});

#region daily achievement
it('has monitoring daily achievement index page', function () {
    actingAs($this->user)
        ->get(route('monitoring.daily-achievement.index'))
        ->assertOk();
});

it('has monitoring daily achievement create page', function () {
    actingAs($this->user)
        ->get(route('monitoring.daily-achievement.create'))
        ->assertOk();
});
#endregion daily achievement
