<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class PostMedia extends Model
{
        protected $guarded = [];  

        public function post(){
            return $this->belongsTo(Post::class);
        }

}
