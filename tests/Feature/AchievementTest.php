<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->forBranch()->create();
});

it('has achievement index page', function () {
    actingAs($this->user)->get(route('achievement.index'))->assertOk();
});

it('has achievement dashboard-pencapaian page', function () {
    actingAs($this->user)->get(route('achievement.dashboard-pencapaian'))->assertOk();
});

it('has achievement dashboard-growth-new-cin page', function () {
    actingAs($this->user)->get(route('achievement.dashboard-growth-new-cin'))->assertOk();
});

it('has achievement dashboard-penutupan-cin page', function () {
    actingAs($this->user)->get(route('achievement.dashboard-penutupan-cin'))->assertOk();
});
