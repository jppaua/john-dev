<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MentionUsersTest extends TestCase
{
	use DatabaseMigrations;
    
    /** @test */
    function mentioned_users_in_a_reply_are_notified()
    {
    	$john = create('App\User', ['name' => 'JohnDoe']);

    	$this->signIn($john);


    	$jane = create('App\User', ['name' => 'JaneDoe']);

    	$thread = create('App\Thread');

    	$reply = make('App\Reply', [
    		'body' => '@JaneDoe look at this.'
    	]);

    	$this->json('post', $thread->path() . '/replies', $reply->toArray());

    	$this->assertCount(1, $jane->notifications);
    }
}
