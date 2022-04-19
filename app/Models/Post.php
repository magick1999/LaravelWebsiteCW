<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia{
    use HasFactory, InteractsWithMedia;

        public function registerMediaConversions(Media $media = null):void{
            $this->addMediaConversion('thumb')
                ->width(80)
                ->height(80);
        }

    /**
    * This function returns who the post belongs to
    * @return User
    */
    public function getUser(){
        return $this->belongsTo(User::class);
    }

    /**
    * Get the comments of the current post
    *
    * @return Comment array
    */
    public function getComments(){
        return $this->morphMany(Comment::class, 'commentable');
    }


    /**
    * Get the likes of the current post
    *
    * @return Like array
    */
    public function getLikes(){
        return $this->hasMany(Like::class);
    }

    /**
    * This deletes the comments under the post and then the post itself
    */
    public function delete(){
        foreach ($this->getComments as $comment) {
            $comment->delete();
        }

        return parent::delete();
    }

    protected $fillable = [
        'text',
        'title',
    ];
}
