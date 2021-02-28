@extends('layouts.app')

@section('content')

            <div class="col-lg-8 col-12">
                <div class="contact-form-wrap">
                    <h2 class="contact__title">Get in touch</h2>
                    <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </p>
                   
                    {!! Form::open(['route' => 'frontend.do_Contact','method' => 'post','id' => 'contact-form']) !!}

                        <div class="single-contact-form ">
                            {!! Form::text('name' , old('name'), ['placeholder' => 'Your name here'])!!}
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
        
                          
                        </div>
                        <div class="single-contact-form space-between">
                            {!! Form::email('email' , old('email'), ['placeholder' => 'Your email here'])!!}
                            {!! Form::text('mobile' , old('mobile'), ['placeholder' => 'Your mobile here'])!!}
                        </div>
                        <div class="single-contact-form space-between">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                            @error('mobile')<span class="text-danger">{{$message}}</span>@enderror
                         
                        </div>
                        <div class="single-contact-form">
                            {!! Form::text('title' , old('title'), ['placeholder' => 'Your subject here'])!!}
                            @error('title')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="single-contact-form message">
                            {!! Form::textarea('message' , old('message'), ['placeholder' => 'Your message here'])!!}
                            @error('message')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="contact-btn">
                            {!!  Form::submit('Send Message',['class' => 'btn btn-primary'])!!}

                        </div>
                        {!! Form::close() !!}

                    

                 {{--   <form id="contact-form" action="{{route('frontend.do_Contact')}}" method="get">
                        @CSRF 
                            <div class="single-contact-form ">
                                <input type="text" name="name" placeholder="First Name*">
                                @error('name')<span class="text-danger">{{$message}}</span>@enderror

                            </div>
                            <div class="single-contact-form space-between">
                                <input type="email" name="email" placeholder="Email*">
                                <input type="text" name="mobile" placeholder="Website*">
                            </div>
                            <div class="single-contact-form">
                                <input type="text" name="title" placeholder="Subject*">
                            </div>
                            <div class="single-contact-form message">
                                <textarea name="message" placeholder="Type your message here.."></textarea>
                            </div>
                            <div class="contact-btn">
                                <button type="submit">Send Email</button>
                            </div>
                        </form> --}}
                    </div> 
              
            </div>
            <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
                <div class="wn__address">
                    <h2 class="contact__title">Get office info.</h2>
                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. </p>
                    <div class="wn__addres__wreapper">

                        <div class="single__address">
                            <i class="icon-location-pin icons"></i>
                            <div class="content">
                                <span>address:</span>
                                <p>{!! getSettingsOf('address') !!}</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-phone icons"></i>
                            <div class="content">
                                <span>Phone Number:</span> 
                                <p>{!! getSettingsOf('phone_number') !!}</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-envelope icons"></i>
                            <div class="content">
                                <span>Email address:</span>
                                <p>{!! getSettingsOf('site_email') !!}</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-globe icons"></i>
                            <div class="content">
                                <span> site website</span>
                                <p>{!! getSettingsOf('site_title') !!}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

   
@endsection
