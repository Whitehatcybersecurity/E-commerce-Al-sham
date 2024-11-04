@extends('frontend.layouts.frontend_main_master')
@section('content')
<main class="main login-page">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Sign Up</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <div class="page-content">
        <div class="container">
            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#sign-in" class="nav-link active">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <form action="{{ route('registerstore') }}" name="register" id="register" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-pane active" id="sign-up">
                                <div class="form-group">
                                    <label>User name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txtUsername" id="txtUsername"
                                        placeholder="Enter User Name" title="Enter User Name" required>
                                    @error('txtUsername')
                                        <div class="text-danger">{{ $errors->first('txtUsername') }}
                                        </div>
                                    @enderror
                                    <span class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="txtEmail" id="txtEmail"
                                        placeholder="Enter Email" title="Enter Email" required>
                                    @error('txtEmail')
                                        <div class="text-danger">{{ $errors->first('txtEmail') }}
                                        </div>
                                    @enderror
                                    <span class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mobilenumber" name="txtMobile"
                                        id="txtMobile" placeholder="Enter Mobile" title="Enter Mobile" required>
                                    @error('txtMobile')
                                        <div class="text-danger">{{ $errors->first('txtMobile') }}
                                        </div>
                                    @enderror
                                    <span class="error"></span>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter Password" title="Enter Password" required>
                                        <span class="toggle-password" id="togglePassword">
                                            <i class="fa fa-eye field-icon" id="eyeIcon"></i>
                                          </span>
                                    {{-- <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                                    @error('password')
                                        <div class="text-danger">{{ $errors->first('password') }}
                                        </div>
                                    @enderror
                                    <span class="error"></span>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" placeholder="Enter Confirm Password"
                                        title="Enter Confirm Password" required>
                                        <span class="toggle-password" id="toggleConfirmPassword">
                                            <i class="fa fa-eye field-icon" id="confirmEyeIcon"></i>
                                          </span>
                                    {{-- <span toggle="#confirm_password"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                                    @error('confirm_password')
                                        <div class="text-danger">{{ $errors->first('confirm_password') }}
                                        </div>
                                    @enderror
                                    <span class="error"></span>
                                </div>
                                {{-- <p>Your personal data will be used to support your experience
                                    throughout this website, to manage access to your account,
                                    and for other purposes described in our <a href="#"
                                        class="text-primary">privacy policy</a>.</p>
                                <a href="#" class="d-block mb-5 text-primary">Signup as a vendor?</a>
                                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                    <input type="checkbox" class="custom-checkbox" id="remember" name="remember"
                                        required="">
                                    <label for="remember" class="font-size-md">I agree to the <a href="#"
                                            class="text-primary font-size-md">privacy policy</a></label>
                                </div> --}}
                                {{-- <a href="#" type="submit" class="btn btn-primary">Sign Up</a> --}}
                                <button type="submit" style="cursor: pointer;" class="btn-primary form-control">Sign Up</button>
                                <a class="" href="{{ route('loginview') }}">if you have already accout please sign in ?</a>
                            </div>
                        </form>
                    </div>
                    {{-- @if (isset($businesssettings) ? $businesssettings->facebook_signup == 1 || $businesssettings->google_signup == 1 : '')
                        <p class="text-center">Sign in with social account</p>
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
    <script src="{{ asset('assets/frontend/assets/js/auth/register.js') }}"></script>
@endsection                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         