<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){

        $users = User::all()->map(function ($user) {
            return $user->id;
        })->toArray();

        $posts = Post::all()->map(function ($post) {
            return $post->id;
        })->toArray();

        return [
            'user_id' => $users[array_rand($users)],
            'post_id' => $posts[array_rand($posts)],
        ];
    }
}
