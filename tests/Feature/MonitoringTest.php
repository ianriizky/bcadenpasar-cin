<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->forBranch()->create();
});

it('has monitoring index page', function () {
    actingAs($this->user)->get(route('monitoring.index'))->assertOk();
});

it('has monitoring create page', function () {
    actingAs($this->user)->get(route('monitoring.create'))->assertOk();
});
