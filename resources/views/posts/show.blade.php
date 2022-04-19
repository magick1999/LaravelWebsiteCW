@extends('layouts.app')
@section('title','Post Details')
@section('content')
<div class="card p-5 d-flex justify-content-center m-4">
<p class="h2 m-2">{{$post->title}}                             <img src="{{$post->getFirstMediaUrl('post_images', 'thumb') }}" class="m-auto">
</p>
<p class="h5 m-2">Posted by: {{$user->name}}</p>
<p class="h4 ms-5 mb-4 mt-4">{{$post->text}}</p>
<p class="h5 m-2">Likes: {{$likes}}</p>
<div class="d-flex flex-row">

@if(Auth::check())
<a href="{{route('like', ['post'=>$post])}}" class="text-decoration-none h5 btn btn-primary link-white me-2">Drop a like</a>
<a href="{{route('comments.create', ['post'=>$post])}}" class="text-decoration-none h5 btn btn-primary link-white me-2">Leave a comment</a>
<a href="{{route('posts.index')}}" class="text-decoration-none h5 btn btn-primary link-white me-2">Back</a>
@if(Auth::user()->hasRole('admin') || Auth::user()->id == $user->id)
@if(Auth::user()->id == $user->id)
     <a href="{{route('posts.edit',['post'=>$post])}}" class="text-decoration-none h5 btn btn-primary link-white me-2">Edit post</a>
@endif
     <form method="POST"
     action="{{route('posts.destroy', ['post'=>$post])}}">
     @csrf
     @method('DELETE')
     <button type="submit" class="text-decoration-none h5 btn btn-primary link-white me-2" style="width: fit-content;">Delete</button>
     </form>
     @endif
     @endif
</div>
</div>
<p class="h4 m-4">Comments</p>
<div class="card p-5 d-flex justify-content-center m-4">
    @foreach($comments as $comment)
    <div class="d-flex justify-content-center flex-row">
    <div class="m-4 card p-5" style="width: 100%;"><a href="{{route('comments.show',
                                                   ['comment'=>$comment])}}" class="text-decoration-none h5 link-dark">{{$comment->text}}</a>
    </div></div>
    @endforeach
</div>
@endsection
