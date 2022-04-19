<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $users = User::all()->map(function ($user) {
            return $user->id;
        })->toArray();

        $userAdmin = new User;
        $userAdmin->name = 'Admin';
        $userAdmin->email = 'admin@domain.com';
        $userAdmin->password = 'Admin@password';
        $userAdmin->save();

        $user = new User;
        $user->name = 'User';
        $user->email = 'user@domain.com';
        $user->password = 'User@password';
        $user->save();

        $users = User::factory();
		$users->has(Post::factory()->count(2));
        $users->count(2);
        $users->create();

    }
}
