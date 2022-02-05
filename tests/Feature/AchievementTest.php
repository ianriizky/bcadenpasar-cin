<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has achievement index page', function () {
    actingAs($this->admin)
        ->get(route('achievement.index'))
        ->assertOk();
});

it('has achievement laporan-pencapaian-new-cin page', function () {
    actingAs($this->admin)
        ->get(route('achievement.laporan-pencapaian-new-cin'))
        ->assertOk();
});

it('has achievement dashboard-growth-new-cin page', function () {
    actingAs($this->admin)
        ->get(route('achievement.dashboard-growth-new-cin'))
        ->assertOk();
});

it('has achievement dashboard-penutupan-cin page', function () {
    actingAs($this->admin)
        ->get(route('achievement.dashboard-penutupan-cin'))
        ->assertOk();
});
