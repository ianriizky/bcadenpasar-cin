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

#region achievement
it('has monitoring achievement index page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.achievement.index'))
        ->assertOk();
});

it('has monitoring achievement create page', function () {
    actingAs($this->admin)
        ->get(route('monitoring.achievement.create'))
        ->assertOk();
});
#endregion achievement
