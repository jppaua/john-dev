<?php

namespace App\Http\Controllers;

use Auth;
use JavaScript;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        if ($request->ajax()) {
            return $user;
        }
        
        $u = $request->user();
        if ($u) {
            $u->revealPersonal();
        }

        JavaScript::put([
            'focusUser' => $user,
            'user' => $request->user()
        ]);

        return view('profile', ['user' => $user ]);
    }
}