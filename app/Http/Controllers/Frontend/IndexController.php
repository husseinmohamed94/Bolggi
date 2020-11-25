<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Auth;

class IndexController extends Controller
{
    public function index(){
        $posts = Post::with(['category','media','user'])
        ->whereHas('category',function($query){
            $query->whereStatus(1);
        })->whereHas('user',function($query){
            $query->whereStatus(1);
        })
        ->wherePostType('post')->whereStatus(1)->orderBy('id','desc')->paginate(5);
        return view('frontend.index',compact('posts'));}





    
    public function post_show($slug){
        $post = Post::with(['category','media','user',
        'approved_comments' =>function($query){
            $query->orderBy('id','desc');
        }
        ]);

        $post =$post->whereHas('category',function($query){
            $query->whereStatus(1);
        })->whereHas('user',function($query){
            $query->whereStatus(1);
        });
      
        $post= $post->whereSlug($slug);
        $post =$post->wherePostType('post')->whereStatus(1)->first();
        if($post){ 
        return view('frontend.post',compact('post'));
        }else{
            return redirect()->route('frontend.index');}
          }



          public function page_show($slug){
            $page = Post::with(['media','user']);
    
           
          
            $page= $page->whereSlug($slug);
            $page =$page->wherePostType('page')->whereStatus(1)->first();
            if($page){ 
            return view('frontend.page',compact('page'));
            }else{
                return redirect()->route('frontend.index');}
              }
    
    


    public function store_comment(Request $request ,$slug){
      $validation = Validator::make($request->all(),[
          'name'                =>  'required',
          'email'               =>  'required|email',
          'comment'             =>  'required:min:10',
          'url'                 =>  'nullable|url',
      ]);
      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput();
      }

        $post = Post::whereSlug($slug)->wherePostType('post')->whereStatus(1)->first();
        if($post){
            $userid = auth()->check() ? auth()->id : null ;
 
            $date['name']               = $request->name;
            $date['email']              = $request->email;
            $date['url']                = $request->url;
            $date['ip_address']         = $request->ip() ;
            $date['comment']            = $request->comment;
            $date['post_id']            = $post->id;
            $date['user_id']            = $userid;
            $post->comments()->create($date);
           // Comment::create($date);
           return redirect()->back()->with([
            'message' => 'comment added Successfully', 
            'alert-type'  => 'success'
           ]);
        }
        return redirect()->back()->with([
            'message' => 'something was wrong', 
            'alert-type'  => 'danger'
           ]);

    }

    public function Contact(){
        return view('frontend.Contact');
    }

    public function do_Contact(Request $request ){
        
    }







}
