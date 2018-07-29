<?php

use App\User;
use App\Membership;
use App\Profile;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create()->each(function ($user) {
            $membership = factory(Membership::class)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
