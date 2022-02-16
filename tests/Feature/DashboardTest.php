<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has dashboard page', function () {
    $response = actingAs($this->user)->get(route('dashboard'));

    if ($this->user->can('view-report')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});
