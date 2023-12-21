@extends('layouts.app')

@section('content')

<section class="enroll-page-heading">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="enroll-page-heading-text">
                    <h3>{{ __('Reset Password') }}</h3>

                </div>
            </div>
        </div>
    </div>
</section>


<section class="">
    <div class="container">
        <div class="row justify-content-center ">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">


                <div class="row-container">


                    <form action="{{ route('forget.password.post') }}" method="POST">

                        @csrf

                        <div class="form-group row">

                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                Address</label>

                            <div class="col-md-6">

                                <input type="text" id="email_address" class="form-control" name="email" required
                                    autofocus>

                                @if ($errors->has('email'))

                                <span class="text-danger">{{ $errors->first('email') }}</span>

                                @endif

                            </div>

                        </div>

                        <div class="col-md-6 offset-md-4">

                            <button type="submit" class="btn btn-primary">

                                Send Password Reset Link

                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection