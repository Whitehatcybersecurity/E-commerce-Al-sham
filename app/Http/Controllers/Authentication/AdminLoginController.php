<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
   

    public function AdminLoginView(){

        return view('backend.admin.adminlogin');
    }

    public function AdminLoginStore(Request $request){

        $validator = Validator::make($request->all(), [
            'txtEmailId' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Invalid credentials!',
                'alert-type' => 'error'
            );
            return redirect()->route('adminloginview')->with($notification);
        }

        $user = User::where('email', $request->txtEmailId)
            ->first();

            $auth = Auth::attempt([
                'email' => $request->txtEmailId,
                'password' => $request->password,
            ], $request->get('remember'));

            if($auth && $user->role_id == 1){
                $notification = array(
                    'message' => 'Logged in successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('dashboardview')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Invalid credentials!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

    }

    public function AdminLogout(Request $request){

        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $notification = array(
            'message' => 'Logged Out Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('adminloginview')->with($notification);
    }
}


