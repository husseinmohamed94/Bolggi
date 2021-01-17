@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        <div class="ml-auto">
            <a href="{{route('admin.posts.create')}}" class="btn btn-primary"><span class="icon text-white-50">
            <i class="fa fa-plus"></i>    
            </span>
             <span class="text"> Add new Posts</span>
        </a>
          
        </div>
    </div>
        <div class="table-responsive">
            <table class="table  tabel-hover" >
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Created at</th>
                        <th class="text-center" style="width:30px;">Action</th>
                    </tr>
                </thead>
              
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td><a href="{{route('admin.posts.show',$post->id)}}">{{$post->title}}</a> </td>
                            <td>{{$post->comment_able==1 ? $post->comments->count():'Disallow'}}</td>
                            <td>{{$post->status()}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->created_at->format('d-m-Y:i a')}}</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{route('admin.posts.edit',$post->id)}}" class="btn-btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)"
                                onclick="if(confirm('Are you sure to delete this post')){document.getElementById('post-delete-{{$post->id}}').submit();}else{return fales;} "
                                class="btn-btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST" id="post-delete-{{$post->id}}">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                   
                    @empty
                        <td colspan="7" class="text-center"> No Posts found</td>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">
                            <div class="float-right">
                                 {!! $posts->appends(request()->input())->links()!!}
                            </div>
                        </th>
                   
                    </tr>
                </tfoot>
            </table>
        </div>
</div>
@endsection