<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogPost extends Model
{
    use HasFactory;

    //protected $table = 'posts';

    //protected $primaryKey = 'blog_id'

    //protected $timestamps = false;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id'
    ];

    public function blogHasUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function blogHasCategory(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

}
