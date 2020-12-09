<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades;
use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;
class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index(){

      $posts = auth()->user()->posts()->with(['media','category','user'])
      ->withCount('comments')
      ->orderBy('id','desc')->paginate(10);
      return view('frontend.users.dashboard',compact('posts'));
    }
    public function create_post(){
        $categories = Category::whereStatus(1)->pluck('name','id');
        return view('frontend.users.create_post',compact('categories'));
    }
    public function store_post(Request $request){
            $validate = Validator::make($request->all(),[
             

                'title'                 =>'required',
                'description'           => 'required',
                'status'                =>  'required',
                'comment_able'          => 'required',
                'category_id'           => 'required',

            ]);
         if($validate->fails()){
             return redirect()->back()->withErrors($validate)->withInput();
         }

         $data['title']              = $request->title;
         $data['description']        = Purify::clean($request->description);
         $data['status']             = $request->status;
         $data['comment_able']       = $request->comment_able;
         $data['category_id']        = $request->category_id;

         $post = auth()->user()->posts()->create($data);

         if($request->images && count($request->images) > 0 ){
             $i = 1;
             foreach($request->images as $file){
                 $filename = $post->slug.'-'.time().'-'.$i. '.' .$file->getClientOriginalExtension();
                 $file_size = $file->getSize();
                 $file_type = $file->getMimeType();
                 $path = public_path('assets/post/'.$filename);
                 
                 Image::make($file->getRealPath())->resize(800,null,function($constraint){
                    $constraint->aspectRatio();
                 })->save($path,100);
                 $post->media()->create([
                    'file_name'     => $filename,
                    'file_size'     => $file_size,
                    'file_type'     => $file_type,
                 ]);
                 $i++;

             }
         } 

         if($request->status == 1){
             Cache::forget('recent_posts');
         }

         return redirect()->back()->with([
            'message'  => 'post created Successfully',
            'alert-type' => 'success',
         ]);
    }
    public function edit_post($post_id){
        $post = Post::whereSlug($post_id)->orwhere('id',$post_id)->whereUserId(auth()->id())->first();
        if($post){
            $categories = Category::whereStatus(1)->pluck('name','id');
            return view('frontend.users.edit_post',compact('post','categories'));
        }
     
        return redirect()->route('frontend.index');
    }

    public function update_post(Request $request , $post_id){
//
    }

    public function destroy_post_media($media_id){

    }


}
