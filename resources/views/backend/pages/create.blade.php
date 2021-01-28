@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">Create page</h6>
        <div class="ml-auto">
            <a href="{{route('admin.pages.index')}}" class="btn btn-primary"><span class="icon text-white-50">
            <i class="fa fa-home"></i></span>
            <span class="text"> pages</span>
        </a>
        </div>
    </div>
       <div class="crad-body">
        {!! Form::open(['route' => 'admin.pages.store','method ' => 'POST' ,'files' => true]) !!}   
       <div class="row">
           <div class="col-12">
                <div class="form-group">
                    {!! Form::label('title','Title') !!}
                    {!! Form::text('title',old('title'),['class' => 'form-control']) !!}
                @error('title') <span> {{$message}}</span> @enderror
                </div>
           </div>
       </div>

       <div class="row">
          <div class="col-12">
             <div class="form-group">
                    {!! Form::label('description','description') !!}
                    {!! Form::textarea('description',old('description'),['class' => 'form-control summernote']) !!}
                     @error('description') <span> {{$message}}</span> @enderror
            </div>
         </div>
        </div>

         <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('category_id','category_id') !!}
                    {!! Form::select('category_id',['' => '---'] + $categories->toArray() , old('category_id'),['class' => 'form-control']) !!}
                 @error('category_id') <span> {{$message}}</span> @enderror
                 </div>

            </div>
          
            <div class="col-6">
                {!! Form::label('status','status') !!}
                {!! Form::select('status',['1' => 'Active','0' => 'Inactive']  , old('status'),['class' => 'form-control']) !!}
             @error('status') <span> {{$message}}</span> @enderror
            </div>
         </div>
            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('Sliders','images') !!}

                    <div class="file-loding">
                        {!! Form::file('images[]',['id' => 'page-images','class' => 'fille-input-overview' , 'multiple' => 'multiple']) !!}
                        <span class="form-text text-muted"> Image width should be 800px 500px</span>
                        @error('images') <span> {{$message}}</span> @enderror

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
        $('#page-images').fileinput({
            theme: "fas",
            maxFileCount: 5,
            allowedFileTypes:['image'],
            showCancel: true,
            showRemove:false,
            showUpload: false,
            overwriteInitial:false,
        });

    });
    </script>
@endsection
