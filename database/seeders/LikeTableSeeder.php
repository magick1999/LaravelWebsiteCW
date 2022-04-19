<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $l0 = new Like;
        $l0->user_id = 1;
        $l0->post_id = 1;
        $l0->save();
    }
}
