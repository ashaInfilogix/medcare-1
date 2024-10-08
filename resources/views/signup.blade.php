@extends('layouts.frontend-layout')
@section('title', 'Sign Up')

@section('content')
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/page/sign-up.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box px-4">
                    <div class="log-in-title">
                        <h4>Create New Account</h4>
                    </div>

                    <div class="input-box">
                        <form class="row g-4" method="POST" action="{{ route('create-account') }}">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" name="name" id="fullname" placeholder="Full Name" value="{{ old('name') }}" @class(['form-control', 'is-invalid' => $errors->has('name')])>
                                    <label for="fullname">Full Name</label>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="email" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}" @class(['form-control', 'is-invalid' => $errors->has('email')])>
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="phone_number" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" @class(['form-control', 'is-invalid' => $errors->has('phone_number')])>
                                    <label for="phone_number">Phone number</label>
                                    @error('phone_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}" @class(['form-control', 'is-invalid' => $errors->has('password')])>
                                    <label for="password">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" value="{{ old('confirm_password') }}" @class(['form-control', 'is-invalid' => $errors->has('confirm_password')])>
                                    <label for="confirmPassword">Confirm Password</label>
                                    @error('confirm_password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="forgot-box">
                                    <div class="form-check ps-0 m-0 remember-box">
                                        <input name="terms" class="checkbox_animated check-box" type="checkbox" id="acceptTerms" value="accepted" @checked(old('terms'))>
                                        <label class="form-check-label" for="acceptTerms">
                                            I agree with <span>Terms</span> and <span>Privacy</span>
                                        </label>
                                    </div>
                                </div>
                                @error('terms')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button class="btn btn-animation w-100" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>

                    <div class="other-log-in">
                        <h6></h6>
                    </div>

                    <div class="sign-up-box">
                        <h4>Already have an account?</h4>
                        <a href="{{ route('login') }}">Log In</a>
                    </div>
                </div>
            </div>

            <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
        </div>
    </div>
</section>
@endsection