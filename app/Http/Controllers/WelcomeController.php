<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function posts()
//     {
//         $posts = Post::all();
// 		return view('dashboard.posts', ['posts'=>$posts]);
//     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function comments()
//     {
//         $comments = Comment::all();
//         return view('dashboard.comments', ['comments'=>$posts]);
//     }
//
    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function load()
        {
            $user = Auth::user();
            $posts = Post::all();
    		return view('welcome', ['posts'=>$posts]);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//         'title' => 'required|max:255',
//         'text' => 'required|max:255',
//         ]);
//
//         $a = new Post;
//         $a->user_id = Auth::user()->id;
//         $a->title = $validatedData['title'];
//         $a->text = $validatedData['text'];
//         $a->save();
//
//         session()->flash('message','post was created');
//         return redirect()->route('posts.index');
//     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//     public function destroy(Post $post)
//     {
//         $post->delete();
//
//         return redirect()->route('posts.index')->with('message', 'Post was deleted');
//     }
}
