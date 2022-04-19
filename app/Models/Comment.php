<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    use HasFactory;

    /**
    * This function returns who the post belongs to
    * @return User
    */
    public function getUser(){
        return $this->belongsTo(User::class);
    }

    /**
         * Get the parent commentable comment
    */
    public function isCommentable(){
        return $this->morphTo();
    }

    /**
    * This function returns the replies to the comment if it can be replied to
    * @return Comment array
    */
    public function getReplies(){
        return $this->morphMany(Comment::class, 'isCommentable');
    }

    /**
    * This function returns to what post it is attributed to
    * @return Post
    */
    public function getPost(){
        return $this->belongsTo(Post::class);
    }

    protected $fillable = [
        'text',
    ];

    /**
    * This deletes the comments under the post and then the comment itself
    */
    public function delete(){
        foreach ($this->getReplies() as $comment) {
            $comment->delete();
        }

        return parent::delete();
    }
}
