<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has report index page', function () {
    $response = actingAs($this->user)->get(route('report.index'));

    if ($this->user->can('view-report')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has report laporan-pencapaian-new-cin index page', function () {
    $response = actingAs($this->user)->get(route('report.laporan-pencapaian-new-cin.index'));

    if ($this->user->can('view-report')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has report dashboard-growth-new-cin index page', function () {
    $response = actingAs($this->user)->get(route('report.dashboard-growth-new-cin.index'));

    if ($this->user->can('view-report')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has report dashboard-penutupan-cin index page', function () {
    $response = actingAs($this->user)->get(route('report.dashboard-penutupan-cin.index'));

    if ($this->user->can('view-report')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});
