@extends('layouts.frontend-layout')
@section('title', 'Verify Email')

@section('content')
<section class="log-in-section otp-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/inner-page/otp.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="log-in-box">
                        <x-success-message :message="session('success')" />
                        <x-error-message :message="session('error')" />
                        
                    <form action="{{ route('verify-otp') }}" id="otp-form" class="signin-form" method="post">
                        @csrf
                        <div class="log-in-title">
                            <h3 class="text-title">Please enter the one time password to verify your account</h3>
                            <h5 class="text-content">A code has been sent to <span>*******9897</span></h5>
                        </div>

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" id="otp" name="otp" value="">
                        <div class="inputs d-flex flex-row justify-content-center">
                            <input class="text-center form-control rounded otp-field" type="text" maxlength="1" placeholder="0">
                            <input class="text-center form-control rounded otp-field" type="text" maxlength="1" placeholder="0">
                            <input class="text-center form-control rounded otp-field" type="text" maxlength="1" placeholder="0">
                            <input class="text-center form-control rounded otp-field" type="text" maxlength="1" placeholder="0">
                            <input class="text-center form-control rounded otp-field" type="text" maxlength="1" placeholder="0">
                            <input class="text-center form-control rounded otp-field" type="text" maxlength="1" placeholder="0">
                        </div>
                        <div class="send-box pt-4">
                            <h5>Didn't get the code? <a href="javascript:void(0)" class="theme-color fw-bold">Resend
                                    It</a></h5>
                        </div>

                        <button onclick="location.href = 'index-2.html';" class="btn btn-animation w-100 mt-3"
                            type="submit">Validate</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.otp-field').on('input', function(e) {
            var current = $(this);
            var next = current.next('.otp-field');
            if (current.val().length >= current.attr('maxlength')) {
                if (next.length) {
                    next.focus();
                }
            }
        });

        $('#otp-form').on('submit', function() {
            var otp = '';
            $('.otp-field').each(function() {
                otp += $(this).val();
            });
            $('#otp').val(otp);
        });
    });
</script>
@endsection