<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function RegisterView(){

        return view('frontend.auth.register');
    }

    public function RegisterStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txtUsername' => 'required',
            'txtEmail' => [
                'required',
                Rule::unique('users', 'email')
            ],
            'txtMobile' => [
                'required',
                'digits:10',
                Rule::unique('users', 'mobile_number')
            ],
            'password' => 'required',

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'User Already Registered Please Login',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
      
            User::Create([
                'name' => $request->txtUsername,
                'email' => $request->txtEmail,
                'mobile_number' => $request->txtMobile,
                'role_id' => 2,
                'password' => Hash::make($request->password),
                // 'referral_code' => $this->generateReferralCode(),
                // 'is_approved' => 1
            ]);

        $notification = array(
            'message' => 'Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('loginview')->with($notification);
    }
}
