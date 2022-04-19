<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model{
    use HasFactory;

    /**
    * This function returns who the like belongs to
    * @return User
    */
    public function getUser(){
        return $this->belongsTo(User::class);
    }

    /**
    * This function returns to what post it is attributed to
    * @return Post
    */
    public function getPost(){
        return $this->belongsTo(Post::class);
    }

}
