<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Min | Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- MATERIAL DESIGN ICONIC FONT -->
        <link rel="stylesheet" href="{{ asset('sale_assets/register/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
        
        <!-- STYLE CSS -->
        <link rel="stylesheet" href="{{ asset('sale_assets/register/css/style.css') }}">
    </head>

    <body>

        <div class="wrapper" style="background-image: url('{{ asset('sale_assets/register/images/bg-registration-form-2.jpg') }}');">
            <div class="inner" style="padding-top: 25px;">
                <form action="{{ asset('register') }}" method="post">
                    <h3>Registration Form</h3>
                    @csrf
                    <div class="form-wrapper">
                        <label for="">Name <span style="color: red;">*</span> </label>
                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-wrapper">
                        <label for="">Email <span style="color: red;">*</span> </label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">

                        <div class="form-wrapper">
                            <label for="">Password <span style="color: red;">*</span> </label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        </div>
                        <div class="form-wrapper">
                            <label for="">Confirm Password <span style="color: red;">*</span> </label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-wrapper">
                            <label for="">Mobile <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" required="" name="mobile">
                    </div>
                    <div class="form-group">
                        <div class="form-wrapper">
                            <label for="">Gender <span style="color: red;">*</span> </label>
                            <select name="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-wrapper">
                            <label for="">Address <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" required="" name="address">
                        </div>
                        
                    </div>
                    
                    <button type="submit" >Register Now</button>
                </form>
            </div>
        </div>
        
    </body>
</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ asset('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
