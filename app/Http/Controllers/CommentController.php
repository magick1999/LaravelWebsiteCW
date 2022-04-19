<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $comments = Comment::where('commentable_id', $post->id)->get();
		return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('comments.create', ['post'=>$post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
        'text' => 'required|max:255',
        ]);

        if($post->user_id != Auth::user()->id){
            User::findOrFail($post->user_id)->notify(new PostNotification($post));
        }

        $a = new Comment;
        $a->user_id = Auth::user()->id;
        $a->commentable_id = $post->id;
        $a->commentable_type = "App\Models\Comment";
        $a->text = $validatedData['text'];
        $a->save();

        session()->flash('message','comment was created');
        return redirect()->route('posts.show', ['post'=>$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $user = User::where('id', $comment->user_id)->get()[0];
        $post = Post::where('id', $comment->commentable_id)->get()[0];
		return view('comments.show',['comment'=>$comment, 'post'=>$post, 'user'=>$user]);
    }

    /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
    public function showUserComments()
    {
        $user = Auth::user();
        $comments = Comment::where('user_id', $user->id)->get();
        return view('comments.show',['comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
        'text' => 'required|max:255',
        ]);

        $post = Post::findOrFail($comment->commentable_id);

        if($post->user_id != Auth::user()->id){
            User::findOrFail($post->user_id)->notify(new PostNotification($post));
        }

        $comment->text = $validatedData['text'];

        $comment->save();

        session()->flash('message','post was created');
        return redirect()->route('comments.show',['comment'=>$comment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        if($post->user_id != Auth::user()->id){
            User::findOrFail($post->user_id)->notify(new PostNotification($post));
        }

        $comment->delete();

        return redirect()->route('posts.show', ['post'=>$post])->with('message', 'Comment was deleted');
    }
}
