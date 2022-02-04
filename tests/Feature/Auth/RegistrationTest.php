<?php

namespace Tests\Feature\Auth;

use App\Models\Branch;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get(route('register'));

        $response->assertOk();
    }

    public function test_new_users_can_register()
    {
        Event::fake();

        /** @var \App\Models\Branch $branch */
        $branch = Branch::first();

        /** @var \App\Models\User $user */
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'branch_id' => $branch->getKey(),

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
