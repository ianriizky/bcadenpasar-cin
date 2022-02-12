<?php

use function Pest\Laravel\actingAs;

it('has master index page', function () {
    actingAs(pest_create_random_user())
        ->get(route('master.index'))
        ->assertOk();
});
