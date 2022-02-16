<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has education index page', function () {
    $response = actingAs($this->user)->get(route('education.index'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

#region webinar-literasi-keuangan
it('has education webinar-literasi-keuangan index page', function () {
    $response = actingAs($this->user)->get(route('education.webinar-literasi-keuangan.index'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has education webinar-literasi-keuangan template-surat-penawaran-webinar page', function () {
    $response = actingAs($this->user)->get(route('education.webinar-literasi-keuangan.template-surat-penawaran-webinar'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has education webinar-literasi-keuangan template-presentasi-webinar-literasi-keuangan page', function () {
    $response = actingAs($this->user)->get(route('education.webinar-literasi-keuangan.template-presentasi-webinar-literasi-keuangan'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has education webinar-literasi-keuangan template-rundown-webinar-literasi-keuangan page', function () {
    $response = actingAs($this->user)->get(route('education.webinar-literasi-keuangan.template-rundown-webinar-literasi-keuangan'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has education webinar-literasi-keuangan pemetaan-sekolah-kampus-potensi-webinar page', function () {
    $response = actingAs($this->user)->get(route('education.webinar-literasi-keuangan.pemetaan-sekolah-kampus-potensi-webinar'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has education webinar-literasi-keuangan input-rencana-penyelenggaraan-webinar page', function () {
    $response = actingAs($this->user)->get(route('education.webinar-literasi-keuangan.input-rencana-penyelenggaraan-webinar'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});
#endregion webinar-literasi-keuangan

it('has education pembukaan-rekening-online page', function () {
    $response = actingAs($this->user)->get(route('education.pembukaan-rekening-online'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has education employee-get-cin page', function () {
    $response = actingAs($this->user)->get(route('education.employee-get-cin'));

    if ($this->user->can('view-education')) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});
