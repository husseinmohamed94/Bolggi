@extends('layouts.app-auth')

@section('content')
{{--
	<!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Login</h3>
                            {!! Form::open(['route' => 'password.email','method' => 'post'])!!}
                            <div class="account__form">
                                <div class="input__box">
                                    {!! Form::label('email','Email *') !!}
                                    {!! Form::email('email',old('email')) !!}
                                @error('email') <span class="text-danger"> {{ $message }}</span> @enderror
                                </div>
                               
                                <div class="form__btn">
                                    {!! Form::button('Send Password Reset Link',['type' => 'submit']) !!}

                                   
                                </div>
                            <a class="forget_pass" href="{{route('frontend.show_login_form')}}">Login </a>
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
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                  

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
