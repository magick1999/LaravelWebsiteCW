<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostNotification;


class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $likes = Like::where('post_id', $post->id)->count();
		return $likes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like(Post $post)
    {
        if(Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->count() < 1){

            if($post->user_id != Auth::user()->id){
                User::findOrFail($post->user_id)->notify(new PostNotification($post));
            }

            $a = new Like;
            $a->user_id = Auth::user()->id;
            $a->post_id = $post->id;
            $a->save();
            session()->flash('message','comment was created');
        }

        return redirect()->route('posts.show', ['post'=>$post]);
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
    public function show(Post $post, Comment $comment)
    {
		return view('comments.show',['comment'=>$comment, 'post'=>$post]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//     public function destroy(Post $post, Comment $comment)
//     {
//         $comment->delete();
//
//         return redirect()->route('posts.show', ['post'=>$post])->with('message', 'Comment was deleted');
//     }
}
