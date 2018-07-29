<?php
//
//namespace Tests\Unit;
//
//use App\PostalAddress;
//use App\User;
//
//use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//
//class UserTest extends TestCase
//{
//    public function testUserCreation()
//    {
//        $firstName = "Tracy";
//        $lastName = "Triathalon";
//        $gender = "female";
//
//        $user = factory(User::class)->create([
//            'first_name' => $firstName,
//            'last_name' => $lastName,
//            'gender' => $gender
//        ]);
//
//        $this->assertEquals($user->first_name, $firstName);
//        $this->assertEquals($user->last_name, $lastName);
//        $this->assertEquals($user->gender, $gender);
//        $this->assertEquals($user->name, "$firstName $lastName");
//    }
//
//    public function testUserHasPostalAddresses()
//    {
//        $user = $this->user;
//
//        $this->assertEquals(0, $user->postalAddresses()->get()->count());
//
//        for ($i = 1; $i < 3; $i++) {
//            $postalAddress = factory(PostalAddress::class)->create(['addressable_id' => $user->id]);
//            $this->assertEquals($i, $user->postalAddresses()->get()->count());
//        }
//    }
//}
