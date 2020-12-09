@extends('layouts.app')

@section('content')
  <!-- Start Blog Area -->
  <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-page">
                   
                    @forelse ($posts as $post)
                        
                      <!-- Start Single Post -->
                      <article class="blog__post d-flex flex-wrap">
                        <div class="thumb">
                            <a href="#">  
                             @if( $post->media->count() > 0)
                                     <img src="{{asset('assets/post/' . $post->media->first()->file_name)}}" alt="{{$post->title}}">
                                     @else

                                     <img src="{{asset('assets/post/default.jpg')}}" alt="blog images">
                                @endif
                            </a>
                        </div>
                        <div class="content">
                        <h4><a href="{{route('posts.show',$post->slug)}}">{{$post->title}}</a></h4>
                            <ul class="post__meta">
                            <li>Posts by : <a href="#">{{$post->user->name}}</a></li>
                                <li class="post_separator">/</li>
                            <li>{{$post->created_at->format('M d Y')}}</li>
                        </ul>
                        <p>{!! \Illuminate\Support\Str::limit($post->description,145,'....') !!}</p>
                            <div class="blog__btn">
                                <a href="{{route('posts.show',$post->slug)}}">read more</a>
                            </div>
                        </div>
                    </article>
                    <!-- End Single Post -->
                        
                   
                    @empty
                        <div class="text-center">No POst Found</div>
                    @endforelse
                  
               
                </div>
                {!! $posts->appends(request()->input())->links() !!}
              
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                @include('partial.frontend.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->

@endsection
