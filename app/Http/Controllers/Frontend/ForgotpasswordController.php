<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotpasswordController extends Controller
{
    public function ForgotpasswordView()
    {

        return view('frontend.auth.forgotpassword');
    }

    public function ForgotpasswordStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'txtForgotemail' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->txtForgotemail,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        // $businessSettings = $this->BussinessSettingdetails();
        // User::where('email', $request->txtForgotemail)->update([
        //     'email_expiry' => now()->addMinutes(2)
        // ]);
        Mail::send('frontend.auth.forgotpassword_email', ['token' => $token, 'email' => $request->txtForgotemail], function ($message) use ($request) {
            $message->to($request->txtForgotemail);
            // $message->from($businessSettings->company_email, env('APP_NAME'));
            $message->from('shamelectranics@gmail.com', 'Ali Al-sham Trading LLC');
            $message->subject('Reset Password');
        });

        $notification = array(
            'message' => 'We have emailed your password reset link!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
