@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">User {{$user->name}}</h6>
        <div class="ml-auto">
            <a href="{{route('admin.users.create')}}" class="btn btn-primary"><span class="icon text-white-50">
            <i class="fa fa-home"></i>    
            </span>
             <span class="text"> users</span>
        </a>
          
        </div>
    </div>
        <div class="table-responsive">
            <table class="table  tabel-hover" >
               
              
                <tbody>
                    <tr>
                        <td colspan="4">
                            @if ($user->user_image != '')   
                                <img src="{{asset('assets/users/' . $user->user_image)}}" alt="" class="img-fluid">
                                @else
                                <img src="{{asset('assets/users/default.png')}}" alt=""class="img-fluid">

                            @endif
                        </td>
                    </tr>
                          
                        <tr>
                            <th>name</th>
                            <td>{{$user->username}}</td>
                            
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{$user->mobil}}</td>
                            <th>SStatus</th>
                            <td>{{$user->status()}}</td>
                        </tr>
                        <tr>
                            <th>create date</th>
                            <td>{{$user->created_at->format('d-m-Y:i a')}}</td>
                            <th>Post Count</th>
                            <td>{{$user->posts_count}}</td>
                            </tr>

                         
                  
                </tbody>
              
            </table>
        </div>
</div>


@endsection
