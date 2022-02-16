<?php

use function Pest\Laravel\actingAs;

it('has master index page', function () {
    $user = pest_create_random_user();

    $response = actingAs($user)->get(route('master.index'));

    if ($user->can('view-master')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});
