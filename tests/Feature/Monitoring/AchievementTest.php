<?php

use App\Models\Achievement;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has achievement index page', function () {
    $response = actingAs($this->user)->get(route('monitoring.achievement.index'));

    if ($this->user->can('viewAny', Achievement::class)) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

