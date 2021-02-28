<?php

namespace App\Http\Livewire\Beckend;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Livewire\Component;

class Statistics extends Component
{
    public function render()
    {
        $all_Users = User::whereHas('roles',function($query){
            $query->where('name','user');
        })->whereStatus(1)->count();

        $active_Posts = Post::whereStatus(1)->wherePostType('post')->count();
        $inactive_Posts = Post::whereStatus(0)->wherePostType('post')->count();
        $active_comments = Comment::whereStatus(1)->count();


        return view('livewire.beckend.statistics',[
           'all_Users'       => $all_Users,
           'active_Posts'    => $active_Posts,
           'inactive_Posts'  => $inactive_Posts,
           'active_comments' => $active_comments,
        ]);
    }
}
