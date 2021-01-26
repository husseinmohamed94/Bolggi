<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostMedia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;

class PostCommentsController extends Controller
{
   
    public function __construct()
    {
        if(\auth()->check()){
            $this->middleware('auth');
        }else{
            return view('backend.auth.login');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                /* if(!\auth()->user()->ability('admin','manage_post_comments,show_post_comments')){
                            return redirect('admin/index');'
                        }
                class EntrustAbility

                        if (!\auth()->user()->ability('admin','manage_post_comments,show_post_comments')) {
                            return redirect('admin/index');
                        }*/
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $postId = (isset(\request()->post_id) && \request()->post_id != '') ? \request()->post_id : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';


        $comments = Comment::query();

        if($keyword != null){
            $comments= $comments->search($keyword);
        }
        if($postId != null){
            $comments= $comments->wherePostId($postId);
        }
        if($status != null){
            $comments= $comments->whereStatus($status);
        }


       $comments= $comments->orderBy($sort_by,$order_by);
       $comments= $comments->paginate($limit_by);
       
       
       
       
       
       
       
       
        $posts = Post::wherePostType('post')->pluck('title','id'); 
        return view('backend.post_comments.index',compact('comments','posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
              if(!\auth()->user()->ability('admin','create_post_comments')){
                    return redirect('admin/index');
                }
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
            Cache::forget('recent_post_comments');
        }

        return redirect()->route('admin.post_comments.index')->with([
            'message'  => 'post created Successfully',
            'alert-type' => 'success',
        ]);
    }
*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id){}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* if(!\auth()->user()->ability('admin','update_post_comments')){
                return redirect('admin/index');
            }*/
        $comment = Comment::whereId($id)->first();
        return view('backend.post_comments.edit',compact('comment'));

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
        /* if(!\auth()->user()->ability('admin','update_post_comments')){
                return redirect('admin/index');
            }*/
         $validate = Validator::make($request->all(),[
             

            'name'                 =>'required',
            'email'                => 'required|email',
            'url'                  =>  'nullable|url',
            'status'               => 'required',
            'comment'              => 'required',

        ]);
     if($validate->fails()){
         return redirect()->back()->withErrors($validate)->withInput();
     }

     $comment = Comment::whereId($id)->first();
     if($comment){
        $data['name']               = $request->name;
        $data['email']              = $request->email;
        $data['url']                = $request->url;
        $data['comment']            = Purify::clean($request->comment);
        $data['status']             = $request->status;
       
        $comment->update($data);
        Cache::forget('recent_comments');
       
            return redirect()->route('admin.post_comments.index')->with([
                'message'  => 'comment update Successfully',
                'alert-type' => 'success',
             ]);
     }
     return redirect()->route('admin.post_comments.index')->with([
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
            /* if(!\auth()->user()->ability('admin','delete_post_comments')){
                    return redirect('admin/index');
                }*/
      
                $comment = Comment::whereId($id)->first();

             $comment->delete();
             return redirect()->route('admin.post_comments.index')->with([
                'message'  => 'comment deleted Successfully',
                'alert-type' => 'success',
             ]);
         
       
    }

  

}
