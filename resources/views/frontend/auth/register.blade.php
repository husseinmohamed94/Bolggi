@extends('layouts.app-auth')

@section('content')
{{--
<!-- Start My Account Area -->
<section class="my_account_area pt--80 pb--55 bg--white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3">
                <div class="my__account__wrapper">
                    <h3 class="account__title">register</h3>
                        {!! Form::open(['route' => 'frontend.register','method' => 'POST','files' => true ]) !!}
                     
                        <div class="account__form">
                            <div class="input__box">
                                {!! Form::label('name','name *') !!}
                                {!! Form::text('name',old('name')) !!}
                            @error('name') <span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="input__box">
                                {!! Form::label('username','username *') !!}
                                {!! Form::text('username',old('username')) !!}
                            @error('username') <span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="input__box">
                                {!! Form::label('email','Email *') !!}
                                {!! Form::email('email',old('email')) !!}
                            @error('email') <span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="input__box">
                                {!! Form::label('mobile','Mobile *') !!}
                                {!! Form::text('mobile',old('mobile')) !!}
                            @error('mobile') <span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="input__box">
                                {!! Form::label('password','Password *') !!}
                                {!! Form::password('Password') !!}
                                @error('password') <span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="input__box">
                                {!! Form::label('password_confirmation','Re-Password *') !!}
                                {!! Form::password('password_confirmation') !!}
                                @error('password_confirmation') <span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="input__box">
                                {!! Form::label('user_image','User image') !!}
                                {!! Form::file('user_image',['class' => 'custom-file']) !!}
                                @error('user_image') <span class="text-danger"> {{ $message }}</span> @enderror
                            </div>
                            <div class="form__btn">
                                {!! Form::button('Create account',['type' => 'submit']) !!}

                              
                        <a class="forget_pass" href="{{route('frontend.show_login_form')}}">Login</a>
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
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">username</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="name" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_image" class="col-md-4 col-form-label text-md-right">user_image</label>
                        <div class="col-md-6">
                            <input id="user_image" type="file" class="form-control @error('user_image') is-invalid @enderror"  >

                            @error('user_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@endsection
