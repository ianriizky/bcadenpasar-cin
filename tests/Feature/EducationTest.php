<?php

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->admin = pest_create_random_user();
});

it('has education index page', function () {
    actingAs($this->admin)
        ->get(route('education.index'))
        ->assertOk();
});

#region webinar-literasi-keuangan
it('has education webinar-literasi-keuangan index page', function () {
    actingAs($this->admin)
        ->get(route('education.webinar-literasi-keuangan.index'))
        ->assertOk();
});

it('has education webinar-literasi-keuangan template-surat-penawaran-webinar page', function () {
    actingAs($this->admin)
        ->get(route('education.webinar-literasi-keuangan.template-surat-penawaran-webinar'))
        ->assertOk();
});

it('has education webinar-literasi-keuangan template-presentasi-webinar-literasi-keuangan page', function () {
    actingAs($this->admin)
        ->get(route('education.webinar-literasi-keuangan.template-presentasi-webinar-literasi-keuangan'))
        ->assertOk();
});

it('has education webinar-literasi-keuangan template-rundown-webinar-literasi-keuangan page', function () {
    actingAs($this->admin)
        ->get(route('education.webinar-literasi-keuangan.template-rundown-webinar-literasi-keuangan'))
        ->assertOk();
});

it('has education webinar-literasi-keuangan pemetaan-sekolah-kampus-potensi-webinar page', function () {
    actingAs($this->admin)
        ->get(route('education.webinar-literasi-keuangan.pemetaan-sekolah-kampus-potensi-webinar'))
        ->assertOk();
});

it('has education webinar-literasi-keuangan input-rencana-penyelenggaraan-webinar page', function () {
    actingAs($this->admin)
        ->get(route('education.webinar-literasi-keuangan.input-rencana-penyelenggaraan-webinar'))
        ->assertOk();
});
#endregion webinar-literasi-keuangan

it('has education pembukaan-rekening-online page', function () {
    actingAs($this->admin)
        ->get(route('education.pembukaan-rekening-online'))
        ->assertOk();
});

it('has education employee-get-cin page', function () {
    actingAs($this->admin)
        ->get(route('education.employee-get-cin'))
        ->assertOk();
});
