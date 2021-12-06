<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifyAdminController extends Controller
{
    public function VerifyEmail($token)
    {
        if ($token == null || $token == "") {

            // session()->with('status', 'Invalid login details');
            // session()->flash('status', 'Invalid Login attempt');

            return redirect()->route('login')->with('status', 'Invalid login details');
        }

        $user = User::where('email_verification_token', '=', $token)->first();


        if ($user == null) {

            // session()->with('status', 'Invalid Login attempt');
            session()->flash('status', 'Invalid Login attemptL');

            // Session::flash('message', "Invalid Login attempt");
            return redirect()->route('login');
            // return view('auth.login.index')->with('status', 'Invalid Login attempt');
        }

        dd($user);

        $user->email_verified_at = Carbon::now();
        $user->email_verification_token = '';
        $user->save();

        return redirect()->route('login')->with('status', 'Your account is activated, you can log in now');;
        // session()->with('status', 'Your account is activated, you can log in now');
        // session()->flash('status', 'Your account is activated, you can log in now');

        // return redirect()->route('login');
    }
}
