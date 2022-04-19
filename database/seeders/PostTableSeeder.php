<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $post0 = new Post;
        $post0->title = 'Dummy Post 0';
        $post0->text = 'Test Post';
        $post0->user_id = 1;
        $post0->save();

        $post1 = new Post;
        $post1->title = 'Dummy Post 1';
        $post1->text = 'Test Post';
        $post1->user_id = 2;
        $post1->save();
    }
}
