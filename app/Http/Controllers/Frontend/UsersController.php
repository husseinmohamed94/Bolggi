<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
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

     $post = Post::whereSlug($post_id)->orwhere('id',$post_id)->whereUserId(auth()->id())->first();
     if($post){
        $data['title']              = $request->title;
        $data['description']        = Purify::clean($request->description);
        $data['status']             = $request->status;
        $data['comment_able']       = $request->comment_able;
        $data['category_id']        = $request->category_id;
        $post->update($data);

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
            return redirect()->route('frontend.dashboard')->with([
                'message'  => 'post update Successfully',
                'alert-type' => 'success',
             ]);
     }
     return redirect()->back()->with([
        'message'  => ' something was wrong',
        'alert-type' => 'danger',
     ]);
    }

    public function destroy_post($post_id){
        $post = Post::whereSlug($post_id)->orwhere('id',$post_id)->whereUserId(auth()->id())->first();
        if($post){
         if($post->media->count() > 0){
             foreach($post->media as $media){
                if(File::exists('assets/post/' .$media->file_name )){
                    unlink('assets/post/' . $media->file_name);
                    }
                 }
             }
             $post->delete();
             return redirect()->route('frontend.dashboard')->with([
                'message'  => 'post deleted Successfully',
                'alert-type' => 'success',
             ]);
         }
         return redirect()->back()->with([
            'message'  => ' something was wrong',
            'alert-type' => 'danger',
         ]); 
    }
    public function destroy_post_media($media_id){
            $media = PostMedia::whereId($media_id)->first();
            if($media){
                if(File::exists('assets/post/' .$media->file_name )){
                    unlink('assets/post/' . $media->file_name);
                }
                $media->delete();
                return true;
            }
            return false;
    }


}
