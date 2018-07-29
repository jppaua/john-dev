<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Merchant;
use App\Membership;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterMerchantController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/merchant-confirmed';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function index()
    {
        return view('auth.register-merchant');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make(str_random(8)),
            'country_code' => 'CA',
            'profile_id' => Profile::create()->id
        ]);

        $user->membership()->save(new Membership);

        $merchant = Merchant::create([
            'profile_id' => Profile::create()->id,
            'country_code' => 'CA',
            'company_name' => $data['company_name']
        ]);

        $user->merchants()->attach($merchant->id);

        return $user;
    }
}
