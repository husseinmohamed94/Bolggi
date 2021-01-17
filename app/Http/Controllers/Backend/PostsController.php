<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['media','user','category','comments'])->wherePostType('post')->orderBy('id','desc')->paginate(10);
        return view('backend.posts.index',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->pluck('name','id'); 
        return view('backend.posts.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
            $validate = Validator::make($request->all(),[
                'title'                 =>'required',
                'description'           => 'required|min:50',
                'status'                =>  'required',
                'comment_able'          => 'required',
                'category_id'           => 'required',
                'images.*'              => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',    
            ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data['title']              = $request->title;
        $data['description']        = Purify::clean($request->description);
        $data['status']             = $request->status;
        $data['post_type']          = 'post';
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

        return redirect()->route('admin.posts.index')->with([
            'message'  => 'post created Successfully',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['media','category','user','comments'])->whereId($id)->wherePostType('post')->first();
        return view('backend.posts.show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('id','desc')->pluck('name','id'); 
        $post = Post::with(['media'])->whereId($id)->wherePostType('post')->first();
        return view('backend.posts.edit',compact('categories','post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validate = Validator::make($request->all(),[
             

            'title'                 =>'required',
            'description'           => 'required|min:50',
            'status'                =>  'required',
            'comment_able'          => 'required',
            'category_id'           => 'required',
            'images.*'              => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',    

        ]);
     if($validate->fails()){
         return redirect()->back()->withErrors($validate)->withInput();
     }

     $post = Post::whereId($id)->wherePostType('post')->first();
     if($post){
        $data['title']              = $request->title;
        $data['slug']              = null;

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
            return redirect()->route('admin.posts.index')->with([
                'message'  => 'post update Successfully',
                'alert-type' => 'success',
             ]);
     }
     return redirect()->route('admin.posts.index')->with([
        'message'  => ' something was wrong',
        'alert-type' => 'danger',
     ]);
    }


  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::whereId($id)->wherePostType('post')->first();
        if($post){
         if($post->media->count() > 0){
             foreach($post->media as $media){
                if(File::exists('assets/post/' .$media->file_name )){
                    unlink('assets/post/' . $media->file_name);
                    }
                 }
             }
             $post->delete();
             return redirect()->route('admin.posts.index')->with([
                'message'  => 'post deleted Successfully',
                'alert-type' => 'success',
             ]);
         }
         return redirect()->route('admin.posts.index')->with([
            'message'  => ' something was wrong',
            'alert-type' => 'danger',
         ]); 
    }

    public function removeImage(Request $request){
        $media = PostMedia::whereId($request->media_id)->first();
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
