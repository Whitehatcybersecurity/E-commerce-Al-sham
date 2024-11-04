@extends('frontend.layouts.frontend_main_master')
@section('content')
<main class="main login-page">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Sign In</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Sign In</li> 
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    <div class="page-content">
        <div class="container">
            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="" class="nav-link active">Sign In</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                            <form action="{{ route('cusromer.loginstore') }}" id="customerlogin" name="customerlogin" method="POST">
                            @csrf
                            <input type="hidden" id="hdloginmethod" name="hdloginmethod" value="null">
                            <div class="tab-pane active" id="sign-in">
                                <div class="form-group">
                                    <label>Email address *</label>
                                    <input type="text" class="form-control" name="txtemail" id="txtemail"
                                        placeholder="Enter mobile or email"
                                        title="Email address is required" required>
                                    <span class="error"></span>
                                </div>
                                {{-- @if($businesssettings->otp_login == 1)
                                <div class="form-group mb-0 hidden" hidden>
                                    <label>Password *</label>
                                    <input type="password" class="form-control" name="txtpassword" id="txtpassword"
                                        placeholder="Enter Password" title="password is required" required>
                                    <span toggle="#txtpassword"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <span class="error"></span>
                                </div>
                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                    <a style="cursor: pointer;" id="continueWithPassword">Continue With Password</a>
                                    <a style="cursor: pointer;" id="continueWithOtp" hidden>Continue With OTP</a>
                                    <a href="">Last your password?</a>
                                </div>
                                <button type="submit" id="btnName" class="btn btn-primary form-control">Sent OTP</button>
                                @else --}}
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter Password" title="password is required" required>
                                        <span class="toggle-password" id="togglePassword">
                                            <i class="fa fa-eye field-icon" id="eyeIcon"></i>
                                          </span>
                                          <span class="error"></span>
                                </div>
                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                    <a href="{{ route('forgotpasswordview') }}">Last your password?</a>
                                </div>
                                <button type="submit" id="btnName" class="btn btn-primary form-control">Submit</button>
                                {{-- @endif --}}
                                <a href="{{ route('registerview') }}">create new account ?</a>
                            </div>
                        </form>
                    </div>
                    {{-- @if (isset($businesssettings) ? $businesssettings->facebook_signup == 1 || $businesssettings->google_signup == 1 : '')
                        <p class="text-center" >Sign in with social account</p>
                        <div class="social-icons social-icon-border-color d-flex justify-content-center">
                            @if (isset($businesssettings) ? $businesssettings->facebook_signup == 1 : '')
                                <a href="{{ route('facebooklogin') }}"
                                    class="social-icon social-facebook w-icon-facebook"></a>
                            @endif
                            @if (isset($businesssettings) ? $businesssettings->google_signup == 1 : '')
                                <a href="{{ route('googlelogin') }}"
                                    class="social-icon social-google fab fa-google"></a>
                            @endif
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('footer')
    <script src="{{ asset('assets/frontend/assets/js/auth/login.js') }}"></script>
@endsection