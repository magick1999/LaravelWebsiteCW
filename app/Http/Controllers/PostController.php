<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
		return view('posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'title' => 'required|max:255',
        'text' => 'required|max:255',
        'post_image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $a = new Post;
        $a->user_id = Auth::user()->id;
        $a->title = $validatedData['title'];
        $a->text = $validatedData['text'];

        if($request['post_image'] != null)
            $a->addMediaFromRequest('post_image')->toMediaCollection('post_images');

        $a->save();

        session()->flash('message','post was created');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = User::where('id', $post->user_id)->get()[0];
        $comments = app('App\Http\Controllers\CommentController')->index($post);
        $likes = app('App\Http\Controllers\LikeController')->index($post);
		return view('posts.show',['post'=>$post, 'comments'=>$comments, 'likes'=>$likes, 'user'=>$user]);
    }

    /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
    public function showUserPosts(User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();
        return view('posts.show',['posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
        'title' => 'required|max:255',
        'text' => 'required|max:255',
        'post_image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $post->title = $validatedData['title'];
        $post->text = $validatedData['text'];

        if($request['post_image'] != null)
            $post->addMediaFromRequest('post_image')->toMediaCollection('post_images');

        $post->save();

        session()->flash('message','post was created');
        return redirect()->route('posts.show',['post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::user()->id){
            User::findOrFail($post->user_id)->notify(new PostNotification($post));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post was deleted');
    }
}
