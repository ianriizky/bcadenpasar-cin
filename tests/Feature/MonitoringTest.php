<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has monitoring index page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.index'))
        ->assertOk();
});

#region daily achievement
it('has monitoring daily achievement index page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.daily-achievement.index'))
        ->assertOk();
});

it('has monitoring daily achievement create page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.daily-achievement.create'))
        ->assertOk();
});
#endregion daily achievement
