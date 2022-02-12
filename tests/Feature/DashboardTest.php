<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->admin = pest_create_random_user();
});

it('has dashboard page', function () {
    actingAs($this->admin)
        ->get(route('dashboard'))
        ->assertOk();
});
