<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Carbon\Carbon;

class UsersController extends Controller
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
                /* if(!\auth()->user()->ability('admin','manage_users,show_users')){
                            return redirect('admin/index');'
                        }
                class EntrustAbility

                        if (!\auth()->user()->ability('admin','manage_post,show_users')) {
                            return redirect('admin/index');
                        }*/
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';


        $users = User::whereHas('roles',function($query){
            $query->where('name','user');
        });
        if($keyword != null){
           $users=$users->search($keyword);
        }
        
        if($status != null){
           $users=$users->whereStatus($status);
        }


      $users=$users->orderBy($sort_by,$order_by);
      $users=$users->paginate($limit_by);
       
       
       
       
       
       
       
       
        return view('backend.users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            /*if(!\auth()->user()->ability('admin','create_users')){
                return redirect('admin/index');
            }*/
        return view('backend.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            /*  if(!\auth()->user()->ability('admin','create_users')){
                    return redirect('admin/index');
                }*/
            $validate = Validator::make($request->all(),[
                'name'                 =>'required',
                'username'             => 'required|max:20|unique:users',
                'email'                =>  'required|email|unique:users',
                'mobile'               => 'required|numeric|unique:users',
                'status'               => 'required',
                'password'             =>'required|min:8',
            ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data['name']              = $request->name;
        $data['username']          = $request->username;
        $data['email']             = $request->email;
        $data['email_verified_at'] = Carbon::now();
        $data['mobile']            = $request->mobile;
        $data['password']          = bcrypt($request->password);
        $data['status']            = $request->status;
        $data['bio']               = $request->bio;
        $data['receive_email']     = $request->receive_email;


        if($user_image = $request->file('user_image') ){
           
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
            Cache::forget('recent_users');
        }

        return redirect()->route('admin.users.index')->with([
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
            /*  if(!\auth()->user()->ability('admin','display_users')){
                    return redirect('admin/index');
                }*/
        $post = Post::with(['media','category','user','comments'])->whereId($id)->wherePostType('post')->first();
        return view('backend.users.show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* if(!\auth()->user()->ability('admin','update_users')){
                return redirect('admin/index');
            }*/
            $categories = Category::orderBy('id','desc')->pluck('name','id'); 
        $post = Post::with(['media'])->whereId($id)->wherePostType('post')->first();
        return view('backend.users.edit',compact('categories','post'));

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
        /* if(!\auth()->user()->ability('admin','update_users')){
                return redirect('admin/index');
            }*/
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
            return redirect()->route('admin.users.index')->with([
                'message'  => 'post update Successfully',
                'alert-type' => 'success',
             ]);
     }
     return redirect()->route('admin.users.index')->with([
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
            /* if(!\auth()->user()->ability('admin','delete_users')){
                    return redirect('admin/index');
                }*/
      
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
             return redirect()->route('admin.users.index')->with([
                'message'  => 'post deleted Successfully',
                'alert-type' => 'success',
             ]);
         }
         return redirect()->route('admin.users.index')->with([
            'message'  => ' something was wrong',
            'alert-type' => 'danger',
         ]); 
    }

    public function removeImage(Request $request){
        
            /*  if(!\auth()->user()->ability('admin','delete_users')){
                    return redirect('admin/index');
                }*/
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
