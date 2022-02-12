<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has dashboard page', function () {
    actingAs($this->user)
        ->get(route('dashboard'))
        ->assertOk();
});
