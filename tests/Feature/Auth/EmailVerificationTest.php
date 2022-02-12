<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    // public function test_email_verification_screen_can_be_rendered()
    // {
    //     /** @var \App\Models\User $user */
    //     $user = User::factory()->forBranch()->create([
    //         'email_verified_at' => null,
    //     ]);

    //     $response = $this->actingAs($user)->get(route('verification.notice'));

    //     $response->assertOk();
    // }

    // public function test_email_can_be_verified()
    // {
    //     /** @var \App\Models\User $user */
    //     $user = User::factory()->unverified()->forBranch()->create();

    //     Event::fake();

    //     $verificationUrl = URL::temporarySignedRoute(
    //         'verification.verify',
    //         Carbon::now()->addMinutes(60),
    //         ['id' => $user->getKey(), 'hash' => sha1($user->getEmailForVerification())]
    //     );

    //     $response = $this->actingAs($user)->get($verificationUrl);

    //     Event::assertDispatched(Verified::class);
    //     $this->assertTrue($user->fresh()->hasVerifiedEmail());
    //     $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
    // }

    // public function test_email_is_not_verified_with_invalid_hash()
    // {
    //     /** @var \App\Models\User $user */
    //     $user = User::factory()->forBranch()->create([
    //         'email_verified_at' => null,
    //     ]);

    //     $verificationUrl = URL::temporarySignedRoute(
    //         'verification.verify',
    //         Carbon::now()->addMinutes(60),
    //         ['id' => $user->getKey(), 'hash' => sha1('wrong-email')]
    //     );

    //     $this->actingAs($user)->get($verificationUrl);

    //     $this->assertFalse($user->fresh()->hasVerifiedEmail());
    // }
}
