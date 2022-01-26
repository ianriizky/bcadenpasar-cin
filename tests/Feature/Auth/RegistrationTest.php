<?php

namespace Tests\Feature\Auth;

use App\Models\Branch;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get(route('register'));

        $response->assertOk();
    }

    public function test_new_users_can_register()
    {
        /** @var \App\Models\Branch $branch */
        $branch = Branch::factory()->make();

        /** @var \App\Models\User $user */
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'branch_name' => $branch->name,

            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree_with_terms' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
