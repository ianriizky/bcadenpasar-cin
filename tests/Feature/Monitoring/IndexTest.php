<?php

use function Pest\Laravel\actingAs;

it('has monitoring index page', function () {
    actingAs(pest_create_random_user())
        ->get(route('monitoring.index'))
        ->assertOk();
});
