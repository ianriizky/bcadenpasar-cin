<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->admin = pest_create_admin();
});

it('has report index page', function () {
    actingAs($this->admin)
        ->get(route('report.index'))
        ->assertOk();
});

it('has report laporan-pencapaian-new-cin index page', function () {
    actingAs($this->admin)
        ->get(route('report.laporan-pencapaian-new-cin.index'))
        ->assertOk();
});

it('has report dashboard-growth-new-cin index page', function () {
    actingAs($this->admin)
        ->get(route('report.dashboard-growth-new-cin.index'))
        ->assertOk();
});

it('has report dashboard-penutupan-cin index page', function () {
    actingAs($this->admin)
        ->get(route('report.dashboard-penutupan-cin.index'))
        ->assertOk();
});
