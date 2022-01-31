<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->forBranch()->create();
});

it('has dashboard page', function () {
    actingAs($this->user)->get(route('dashboard'))->assertOk();
});
