<?php

namespace Tests\Feature;

use App\User;
use App\Events\MessageSent;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiMessageStore()
    {
        Event::fake();

        $user = User::where('email', 'test@example.com')->first();
        if (!$user) {
            $user = factory(User::class)->create([
                'name' => 'Test',
                'email' => 'test@example.com'
            ]);
        }

        Passport::actingAs($user, [ '*' ]);

        $response = $this->postJson('/api/messages', [ 'message' => 'Test' ]);

        $response->assertStatus(201)->assertJson([
            'data' => [
                'message' => 'Test'
            ]
        ]);

        Event::assertDispatched(MessageSent::class, function ($e) use($user) {
            return $e->user->id == $user->id && $e->message->message == 'Test';
        });

        $user->messages->last()->delete();
    }
}
