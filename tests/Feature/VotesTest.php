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
            ->post('/threads/some_channel/1/upVote')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_upvote_on_any_thread()
    {

        $this->signIn();

        $thread = create('App\Thread');
        
        $this->assertDatabaseMissing('votes', ['upvote' => '1']);
        
        $this->post('/threads/some_channel/' . $thread->id . '/upVote');

        $this->assertCount(1, $thread->votes);

        $this->assertDatabaseHas('votes', ['upvote' => '1']);

        // $this->post('/threads/some_channel/' . $thread->id . '/votes');

        // $this->assertDatabaseHas('votes', ['upvote' => '0']);

        // $this->post('/threads/some_channel/' . $thread->id . '/votes');

        // $this->assertDatabaseHas('votes', ['upvote' => '1']);
    }

    /** @test */
    public function an_authenticated_user_can_downvote_on_any_thread()
    {

        $this->signIn();

        $thread = create('App\Thread');

        $this->assertCount(0, $thread->votes);

        $this->post('/threads/some_channel/' . $thread->id . '/downVote');

        $this->assertCount(1, $thread->votes);

        $this->assertDatabaseHas('votes', ['upvote' => '0']);

        // $this->post('/threads/some_channel/' . $thread->id . '/votes');

        // $this->assertDatabaseHas('votes', ['upvote' => '0']);

        // $this->post('/threads/some_channel/' . $thread->id . '/votes');

        // $this->assertDatabaseHas('votes', ['upvote' => '1']);
    }

    /** @test */
    public function an_authenticated_user_can_downvote_then_upvote_on_any_thread()
    {

        $this->signIn();

        $thread = create('App\Thread');

        $this->post('/threads/some_channel/' . $thread->id . '/downVote');

        $this->assertCount(1, $thread->votes);

        $this->assertDatabaseHas('votes', ['upvote' => '0']);

        $this->post('/threads/some_channel/' . $thread->id . '/upVote');

        $this->assertDatabaseHas('votes', ['upvote' => '1']);

        // $this->post('/threads/some_channel/' . $thread->id . '/votes');

        // $this->assertDatabaseHas('votes', ['upvote' => '0']);

        // $this->post('/threads/some_channel/' . $thread->id . '/votes');

        // $this->assertDatabaseHas('votes', ['upvote' => '1']);
    }

    /** @test */
    public function an_authenticated_user_can_unvote_any_reply()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $thread->downVote();

        // echo $thread->getVotesCountAttribute();

        // $this->assertCount(1, $thread->votes);

        $this->delete('/threads/some_channel/' . $thread->id . '/downVote');

        $this->assertCount(0, $thread->votes);

        $thread->upVote();

        $this->assertCount(1, $thread->fresh()->votes);

        $this->delete('/threads/some_channel/' . $thread->id . '/upVote');

        $this->assertCount(0, $thread->fresh()->votes);
    }



    /** @test*/
    function an_authenticated_user_may_only_vote_on_a_thread_once()
    {
        $this->signIn();

        $thread = create('App\Thread');

        try {
            $this->post('/threads/some_channel/' . $thread->id . '/upVote');
            $this->post('/threads/some_channel/' . $thread->id . '/upVote');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $thread->votes);
    }
}
