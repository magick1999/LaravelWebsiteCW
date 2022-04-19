<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    public function registerMediaConversions(Media $media = null):void{
        $this->addMediaConversion('thumb')
            ->width(80)
            ->height(80);
    }
    /**
    * Get the posts owned by user
    *
    * @return Post array
    */
    public function getPosts(){
        return $this->hasMany(Post::class);
    }

    /**
    * Get the comments owned by user
    *
    * @return Comment array
    */
    public function getComments(){
        return $this->hasMany(Comment::class);
    }

    public function delete(){
            foreach ($this->getComments() as $comment) {
                $comment->delete();
            }

            return parent::delete();
    }

     /**
         * @param string $role
         * @return bool
         */
     public function hasRole($role){
         return $this->getAttribute('role') === $role;
     }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
