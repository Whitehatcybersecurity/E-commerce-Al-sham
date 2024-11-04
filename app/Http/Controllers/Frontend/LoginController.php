<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function LoginView(){

        return view('frontend.auth.login');
    }

    public function CustomerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txtemail'   => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Invalid credentials!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $useremail = User::where('email', $request->txtemail)->pluck('email')->first();

        if ($useremail) {
            $verifyRole = User::where('email',$useremail)->first();

            if ($verifyRole->role_id == 2) {

                if (Auth::attempt([
                    'email' => $useremail,
                    'password' => $request->password,
                ], $request->get('remember'))) {

                    $notification = array(
                        'message' => 'Logged in successfully',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('homeview')->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Invalid credentials!',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
            } else {
                $notification = array(
                    'message' => 'Invalid credentials!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Invalid credentials!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function CustomerLogout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $notification = array(
            'message' => 'Logged Out Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('loginview')->with($notification);
    }

}
