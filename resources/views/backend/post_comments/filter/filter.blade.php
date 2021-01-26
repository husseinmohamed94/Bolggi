<div class="card-body">
    {!! Form::open(['route' => 'admin.post_comments.index' ,'method' => 'get']) !!}

    <div class="row">
        <div class="col-2">
            <div class="form-group">
                {!! Form::text('keyword',old('keyword',request()->input('keyword')),['class' => 'form-control','placeholder' => 'search hier']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('post_id',['' => '---'] + $posts->toArray(),old('[post_id',request()->input('post_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('status',['' => '---' ,'1' => 'Active' , '0' => 'Inactive']  ,old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('sort_by',['' => '---' ,'id' =>'ID', 'name' => 'Name' , 'created_at' => 'Created_at ']  ,old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('orderby',['' => '---' ,'asc' => 'Ascending' , 'desc' => 'Descending ']  ,old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                {!! Form::select('limit_by',['' => '---' ,'10' => '10' , '20' => '20', '50' => '50', '100' => '100']  ,old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                {!! Form::button('search',['class' => 'btn btn-link','type' => 'submit']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}


</div>