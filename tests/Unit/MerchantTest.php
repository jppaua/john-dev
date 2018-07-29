<?php
//
//namespace Tests\Unit;
//
//use App\User;
//use App\Membership;
//use App\Merchant;
//use App\PostalAddress;
//use App\Profile;
//
//use Tests\TestCase;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//
//class MerchantsTest extends TestCase
//{
//    public function testMerchantAssignments()
//    {
//        $user = $this->user;
//
//        $merchant = $this->merchant;
//        $merchant2 = factory(Merchant::class)->create();
//
//        $this->assertEquals($user->merchants()->count(), 0);
//        $this->assertEquals($merchant->users()->count(), 0);
//        $this->assertEquals($merchant2->users()->count(), 0);
//
//        $user->merchants()->attach($merchant->id);
//        $this->assertEquals($user->merchants()->count(), 1);
//        $this->assertEquals($merchant->users()->count(), 1);
//
//        $user->merchants()->attach($merchant2->id);
//        $this->assertEquals($user->merchants()->count(), 2);
//        $this->assertEquals($merchant->users()->count(), 1);
//        $this->assertEquals($merchant2->users()->count(), 1);
//    }
//
//    public function test_merchant_has_postal_addresses()
//    {
//        $merchant = $this->merchant;
//
//        $this->assertEquals(0, $merchant->postalAddresses()->get()->count());
//
//        for ($i = 1; $i < 3; $i++) {
//            $postalAddress = factory(PostalAddress::class)->create([
//                'addressable_id' => $merchant->id,
//                'addressable_type' => 'App\Merchant',
//            ]);
//
//            $this->assertEquals($i, $merchant->postalAddresses()->get()->count());
//        }
//    }
//
//    public function test_create_merchant()
//    {
//        $firstName = $this->faker->firstName;
//        $lastName = $this->faker->lastName;
//        $email = $this->faker->email;
//        $companyName = $this->faker->company;
//
//        $userProfile = factory(Profile::class)->create();
//        $merchantProfile = factory(Profile::class)->create();
//
//        $user = User::create([
//            'first_name' => $firstName,
//            'last_name' => $lastName,
//            'email' => $email,
//            'password' => Hash::make(str_random(8)),
//            'country_code' => 'CA',
//            'profile_id' => $userProfile->id,
//        ]);
//
//        $merchant = Merchant::create([
//            'company_name' => $companyName,
//            'country_code' => 'CA',
//            'profile_id' => $merchantProfile->id,
//        ]);
//
//        $user->merchants()->attach($merchant->id);
//
//        $this->assertEquals($user->name, "$firstName $lastName");
//        $this->assertEquals($user->email, $email);
//        $this->assertEquals($merchant->company_name, $companyName);
//    }
//}
//
