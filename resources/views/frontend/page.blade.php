
@extends('layouts.app')

@section('content')



<div class="page-blog-details section-padding--lg bg--white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="blog-details content">
                    <article class="blog-post-details">
                        @if(!empty($page->media))
                        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($page->media as $media)
                                <li data-target="#carouselIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index == 0 ? 'active' : ''}}"></li>
                                @endforeach
                            </ol>
                            @foreach ($page->media as $media)
                            <div class="carousel-inner">
                            <div class="carousel-item {{$loop->index ==0 ? 'active' : ''}}">
                            <img src="{{asset('assets/post/'.$media->file_name)}}" class="d-block w-100" alt="{{$page->title}}">
                              </div>
                            @endforeach
                            
                            </div>
                            @if ($page->media->count() > 1)
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                            @endif
                          </div>
                            
                        @endif
                      
                        <div class="post_wrapper">
                            <div class="post_header">
                                <h2>{{$page->title}}</h2>
                                <div class="blog-date-categori">
                                    <ul>
                                        <li>{{$page->created_at->format('M d Y')}}</li>
                                        <li><a href="#" title="Posts by {{$page->user->name}}" rel="author">{{$page->user->name}}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="post_content">
                            <p> {!! $page->description !!}</p>

                            </div>
                           
                        </div>
                    </article>
                    
                   
                </div>
            </div>
          
        </div>
    </div>
</div>




@endsection
