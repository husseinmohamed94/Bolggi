@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{'frontend/js/summernote/summernote-bs4.min.css'}}">
@endsection
@section('content')
  <!-- Start Blog Area -->
  <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
              <h3>Create post</h3>
                {!! Form::open(['route' => 'users.post.store','method ' => 'POST' ,'files' => true]) !!}   
                <div class="form-group">
                   {!! Form::label('title','Title') !!}
                   {!! Form::text('title',old('title'),['class' => 'form-control']) !!}
                @error('title') <span> {{$message}}</span> @enderror
                </div>

                 <div class="form-group">
                    {!! Form::label('description','description') !!}
                    {!! Form::textarea('description',old('description'),['class' => 'form-control summernote']) !!}
                 @error('description') <span> {{$message}}</span> @enderror
                 </div>

                 <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('category_id','category_id') !!}
                            {!! Form::select('category_id',['' => '---'] + $categories->toArray() , old('category_id'),['class' => 'form-control']) !!}
                         @error('category_id') <span> {{$message}}</span> @enderror
                         </div>

                    </div>
                    <div class="col-4">
                        {!! Form::label('comment_able','comment_able') !!}
                        {!! Form::select('comment_able',['1' => 'Yes' , '0' => 'No'] , old('comment_able'),['class' => 'form-control']) !!}
                     @error('comment_able') <span> {{$message}}</span> @enderror
                    </div>
                    <div class="col-4">
                        {!! Form::label('status','status') !!}
                        {!! Form::select('status',['1' => 'Active','0' => 'Inactive']  , old('status'),['class' => 'form-control']) !!}
                     @error('status') <span> {{$message}}</span> @enderror
                    </div>
                 </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <div class="file-loding">
                                {!! Form::file('images[]',['id' => 'post-images','multiple' => 'multiple']) !!}
                             </div>
                        </div>
                    </div>
               

                 <div class="form-group pt-4">
                    {!! Form::submit('submit',['class' => 'btn btn-primary']) !!}

                 </div>

                {!! Form::close() !!}
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                @include('partial.frontend.users.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->

@endsection

@section('script')
<script src="{{'frontend/js/summernote/summernote-bs4.min.js'}}"></script>
<script>
    $(function(){
        $('.summernote').summernote({
            tabsize: 2,
             height: 200,
             toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
        ]
        });
        $('#post-images').fileinput({
            theme: "fa",
            maxFileCount: 5,
            allowedFileTypes:['images'],
            showCancel: true,
            showRemove:false,
            showUpload: false,
            overwriteInitial:false,
        });

    });
</script>
@endsection