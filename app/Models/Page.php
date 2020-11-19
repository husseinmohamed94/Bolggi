<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use Sluggable; 
    protected $table ='posts';
    protected $guarded = [];  

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
        public function category(){
            return $this->belongsTo(Category::class,'category_id','id');
        }
        public function user(){
            return $this->belongsTo(User::class,'user_id','id');
        }
       
        public function media(){
            return $this->belongsTo(PostMedia::class,'post_id','id');
        }
}
