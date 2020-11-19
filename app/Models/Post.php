<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Models\PostMedia;
class Post extends Model
{
    use Sluggable; 
    protected $guarded = [];  

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }
        public function category(){
            return $this->belongsTo(Category::class);
        }
        public function user(){
            return $this->belongsTo(User::class);
        }
        public function comments(){
            return $this->hasMany(Comment::class);
        }
        public function media(){
            return $this->belongsTo(PostMedia::class);
        }
}
