<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VotesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_can_not_vote_on_anything()
    {
        $this->withExceptionHandling()
            ->post('/threads/some_channel/1/votes')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_vote_on_any_thread()
    {

        $this->signIn();

        $channel = create('App\Channel');
        $thread = create('App\Thread');


        $this->post('/threads/' . $channel->slug . '/' . $thread->id . '/votes');


        $this->assertCount(1, $thread->votes);
    }

    /** @test*/
    function an_authenticated_user_may_only_vote_on_a_thread_once()
    {
        $this->signIn();

        $channel = create('App\Channel');
        $thread = create('App\Thread');

        try {
            $this->post('/threads/' . $channel->slug . '/' . $thread->id . '/votes');
            $this->post('/threads/' . $channel->slug . '/' . $thread->id . '/votes');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $thread->votes);
    }

}
