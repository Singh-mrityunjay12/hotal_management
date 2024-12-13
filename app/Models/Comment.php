<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id'); //user_id of the comments table and id of the user table
    }

    public function post(){
        return $this->belongsTo(BlogPost::class,'post_id','id');
    }
}
