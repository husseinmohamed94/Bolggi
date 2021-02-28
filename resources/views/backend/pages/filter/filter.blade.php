<div class="card-body">
    {!! Form::open(['route' => 'admin.pages.index' ,'method' => 'get']) !!}

    <div class="row">
        <div class="col-2">
            <div class="form-group">
                {!! Form::text('keyword',old('keyword',request()->input('keyword')),['class' => 'form-control','placeholder' => 'search hier']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('category_id',['' => '---'] + $categories->toArray(),old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('status',['' => '---' ,'1' => 'Active' , '0' => 'Inactive']  ,old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('sort_by',['' => '---' ,'title' => 'Title' , 'created_at' => 'Created_at ']  ,old('category_id',request()->input('category_id')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                {!! Form::select('order_by', ['' => '---', 'asc' => 'Ascending', 'desc' => 'Descending'], old('order_by', request()->input('order_by')), ['class' => 'form-control']) !!}
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