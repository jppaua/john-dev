<?php

namespace Tests\Unit;

use App\PostalAddress;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function a_user_can_fetch_their_most_recent_reply()
	{
		$user = create('App\User');

		$reply = create('App\Reply', ['user_id' => $user->id]);

		$this->assertEquals($reply->id, $user->lastReply->id);
	}
   // public function testUserCreation()
   // {
   //     $firstName = "Tracy";
   //     $lastName = "Triathalon";
   //     $gender = "female";

   //     $user = factory(User::class)->create([
   //         'first_name' => $firstName,
   //         'last_name' => $lastName,
   //         'gender' => $gender
   //     ]);

   //     $this->assertEquals($user->first_name, $firstName);
   //     $this->assertEquals($user->last_name, $lastName);
   //     $this->assertEquals($user->gender, $gender);
   //     $this->assertEquals($user->name, "$firstName $lastName");
   // }

   // public function testUserHasPostalAddresses()
   // {
   //     $user = $this->user;

   //     $this->assertEquals(0, $user->postalAddresses()->get()->count());

   //     for ($i = 1; $i < 3; $i++) {
   //         $postalAddress = factory(PostalAddress::class)->create(['addressable_id' => $user->id]);
   //         $this->assertEquals($i, $user->postalAddresses()->get()->count());
   //     }
   // }
}
