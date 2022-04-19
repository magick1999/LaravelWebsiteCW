<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $c0 = new Comment;
        $c0->text = "Test 0";
        $c0->commentable_id = 1;
        $c0->commentable_type = "App\Models\Post";
        $c0->user_id = 1;
        $c0->save();

        $c1 = new Comment;
        $c1->text = "Test 1";
        $c1->commentable_id = 1;
        $c1->commentable_type = "App\Models\Comment";
        $c1->user_id = 1;
        $c1->save();

        $comments = Comment::factory()
            ->count(10)
            ->state(new Sequence(
                function ($sequence) {
                    $post = Post::all()->random();
                    $user = User::all()->random();

                    return
                        [
                        'user_id' => $user->id,
                        'commentable_id' => $post->id,
                        'commentable_type' => "App\Models\Post",
                    ];
                })
            )
            ->create();

        $comments = Comment::factory()
            ->count(10)
            ->state(new Sequence(
                function ($sequence) {
                    $c = Comment::all()->random();
                    $user = User::all()->random();

                    return
                        [
                        'user_id' => $user->id,
                        'commentable_id' => $c->id,
                        'commentable_type' => "App\Models\Comment",
                    ];
                })
            )
            ->create();
    }
}
