@extends('layouts.app')

@section('content')
{{--
	<!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Login</h3>
                            {!! Form::open(['route' => 'frontend.login','method' => 'post'])!!}
                            <div class="account__form">
                                <div class="input__box">
                                    {!! Form::label('username','username *') !!}
                                    {!! Form::text('username',old('username')) !!}
                                @error('username') <span class="text-danger"> {{$message}}</span> @enderror
                                
                            
                            </div>
                                <div class="input__box">
                                    {!! Form::label('Password','Password * ') !!}
                                    {!! Form::password('Password') !!}
                                    @error('password') <span class="text-danger"> {{$message}}</span> @enderror

                                </div>
                                <div class="form__btn">
                                    {!! Form::button('Login',['type' => 'submit']) !!}

                                    <label class="label-for-checkbox">
                                        <input class="finput-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <span>Remember me</span>
                                    </label>
                                </div>
                            <a class="forget_pass" href="{{route('frontend.password.request')}}">Lost your password?</a>
                            </div>
                            {!! Form::close() !!}
                        
                    
                    </div>
                </div>
              
            </div>
        </div>
    </section>
    <!-- End My Account Area -->

--}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
