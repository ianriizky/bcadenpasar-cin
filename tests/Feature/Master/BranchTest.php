<?php

use App\Models\Branch;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;

beforeEach(function () {
    $this->user = pest_create_random_user();
});

it('has branch index page', function () {
    actingAs($this->user)
        ->get(route('master.branch.index'))
        ->assertOk();
});

it('has branch create page', function () {
    $response = actingAs($this->user)->get(route('master.branch.create'));

    if ($this->user->isAdmin()) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can store branch', function () {
    $data = Branch::factory()->raw();

    $response = actingAs($this->user)->post(route('master.branch.store'), $data);

    if ($this->user->isAdmin()) {
        $response->assertRedirect(route('master.branch.index'));

        assertDatabaseHas(Branch::class, $data);
    } else {
        $response->assertForbidden();
    }
});

it('has branch show page', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    $response = actingAs($this->user)->get(route('master.branch.show', $branch));

    if ($this->user->isAdmin()) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('has branch edit page', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    $response = actingAs($this->user)->get(route('master.branch.edit', $branch));

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertOk();
    } else {
        $response->assertForbidden();
    }
});

it('can update branch', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    $data = Branch::factory()->raw();

    $response = actingAs($this->user)->put(route('master.branch.update', $branch), $data);

    if ($this->user->isAdmin() || ($this->user->isManager() && $this->user->branch->is($branch))) {
        $response->assertRedirect(route('master.branch.edit', Branch::firstWhere('name', $data['name'])));

        assertDatabaseHas(Branch::class, $data);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy branch', function () {
    /** @var \App\Models\Branch $branch */
    $branch = Branch::factory()->create();

    $response = actingAs($this->user)->delete(route('master.branch.destroy', $branch));

    if ($this->user->isAdmin()) {
        $response->assertRedirect(route('master.branch.index'));

        assertModelMissing($branch);
    } else {
        $response->assertForbidden();
    }
});

it('can destroy multiple branch', function () {
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Branch> $branches */
    $branches = Branch::factory()
        ->count(rand(1, 5))
        ->create();

    $response = actingAs($this->user)->delete(route('master.branch.destroy-multiple', [
        'checkbox' => $branches->pluck('id')->toArray(),
    ]));

    if ($this->user->isAdmin()) {
        $response->assertRedirect(route('master.branch.index'));

        foreach ($branches as $branch) {
            assertModelMissing($branch);
        }
    } else {
        $response->assertForbidden();
    }
});
