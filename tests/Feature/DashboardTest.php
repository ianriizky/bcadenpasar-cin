<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has dashboard page', function () {
    actingAs($this->admin)
        ->get(route('dashboard'))
        ->assertOk();
});
