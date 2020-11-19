<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Post;
class Category extends Model
{
    use Sluggable; 
    protected $guarded = [];  

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
        public function posts(){
            return $this->hasMany(Post::class);
        }


    
}
