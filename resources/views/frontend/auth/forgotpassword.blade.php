@extends('frontend.layouts.frontend_main_master')
@section('content')
<main class="main login-page">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Forgot Password</h1>
        </div>
    </div>
    <!-- End of Page Header -->
    <div class="page-content">
        <div class="container">
            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#sign-in" class="nav-link active">Reset Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <form action="{{ route('forgotpassword.store') }}" name="forgotpassword" method="POST">
                            @csrf
                            <div class="tab-pane active" id="sign-in">
                                <div class="form-group">
                                    <label>Email address *</label>
                                    <input type="email" class="form-control" name="txtForgotemail" id="txtForgotemail"
                                        placeholder="Enter your email" title="email address is required" required>
                                    <span class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary form-control">Send Reset Password Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('footer')
    <script src="{{ asset('assets/frontend/assets/js/auth/forgotpassword.js') }}"></script>
@endsection