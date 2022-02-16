<?php

use function Pest\Laravel\actingAs;

it('has monitoring index page', function () {
    $user = pest_create_random_user();

    $response = actingAs($user)->get(route('monitoring.index'));

    if ($user->can('view-monitoring')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});
