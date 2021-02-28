@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">Create users</h6>
        <div class="ml-auto">
            <a href="{{route('admin.users.index')}}" class="btn btn-primary"><span class="icon text-white-50">
            <i class="fa fa-home"></i></span>
            <span class="text"> users</span>
        </a>
        </div>
    </div>
       <div class="crad-body">
        {!! Form::open(['route' => 'admin.users.store','method ' => 'POST' ,'files' => true]) !!}   
       <div class="row">
                    <div class="col-3">
                            <div class="form-group">
                                {!! Form::label('name','Name') !!}
                                {!! Form::text('name',old('name'),['class' => 'form-control']) !!}
                                @error('name') <span> {{$message}}</span> @enderror
                            </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('username;','Username') !!}
                            {!! Form::text('username',old('username'),['class' => 'form-control']) !!}
                            @error('username') <span> {{$message}}</span> @enderror
                        </div>
                     </div>

                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('email','Email') !!}
                        {!! Form::text('email',old('email'),['class' => 'form-control']) !!}
                        @error('email') <span> {{$message}}</span> @enderror
                    </div>
                 </div>
                 <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('mobile','Mobile') !!}
                        {!! Form::text('mobile',old('mobile'),['class' => 'form-control']) !!}
                        @error('mobile') <span> {{$message}}</span> @enderror
                    </div>
            </div>
       </div>




       <div class="row">
       
        <div class="col-3">
            <div class="form-group">
                {!! Form::label('password;','Password') !!}
                {!! Form::password('password',['class' => 'form-control']) !!}
                @error('password') <span> {{$message}}</span> @enderror
            </div>
         </div>

    <div class="col-3">
        <div class="form-group">
            {!! Form::label('status','status') !!}
            {!! Form::select('status',['' => '---','1' => 'Active','0' => 'Inactive']  , old('status'),['class' => 'form-control']) !!}
         @error('receive_email') <span> {{$message}}</span> @enderror
        </div>
     </div>

     <div class="col-6">
        <div class="form-group">
            {!! Form::label('receive_email','Receive email') !!}
            {!! Form::select('receive_email',['' => '---','1' => 'Yes','0' => 'NO']  , old('receive_email'),['class' => 'form-control']) !!}
         @error('status') <span> {{$message}}</span> @enderror
        </div>
     </div>

</div>


       <div class="row">
          <div class="col-12">
             <div class="form-group">
                    {!! Form::label('bio','bio') !!}
                    {!! Form::textarea('bio',old('bio'),['class' => 'form-control']) !!}
                     @error('bio') <span> {{$message}}</span> @enderror
            </div>
         </div>
        </div>

        
            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('user Image','user_image') !!}

                    <div class="file-loding">
                        {!! Form::file('user_image',['id' => 'user-image','class' => 'fille-input-overview' ]) !!}
                        <span class="form-text text-muted"> Image width should be 300px X 300px</span>
                        @error('user_image') <span> {{$message}}</span> @enderror

                    </div>
                </div>
            </div>
       

         <div class="form-group pt-4">
            {!! Form::submit('submit',['class' => 'btn btn-primary']) !!}

         </div>

        {!! Form::close() !!}
     
       </div>
</div>



@endsection

@section('script')
<script>
    $(function(){
      
        $('#user-image').fileinput({
            theme: "fas",
            maxFileCount: 1,
            allowedFileTypes:['image'],
            showCancel: true,
            showRemove:false,
            showUpload: false,
            overwriteInitial:false,
        });

    });
    </script>
@endsection
