<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

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

        // dd($user);

        if ($user == null) {

            // session()->with('status', 'Invalid Login attempt');
            // session()->flash('status', 'Invalid Login attemptL');

            return redirect()->route('login')->with('status', 'Invalid Login attempt');
        }

        $user->email_verified_at = Carbon::now();
        $user->email_verification_token = '';
        $user->save();
        session()->with('status', 'Your account is activated, you can log in now');
        // session()->flash('status', 'Your account is activated, you can log in now');

        return redirect()->route('login');
    }
}
