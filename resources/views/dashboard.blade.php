@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<p class="display-2 text-black text-center m-5">Your Dashboard</p>
<p class="h4 m-4">Your posts</p>
<div class="card p-5 d-flex justify-content-center m-4">
    @foreach($posts as $post)
    <div class="d-flex justify-content-center flex-row">
    <div class="m-4 card p-5" style="width: 100%;"><a class="text-decoration-none h5 link-dark" href="{{route('posts.show',['post'=>$post])}}">
        <div class="mb-4 h3">{{$post->title}}<img src="{{$post->getFirstMediaUrl('post_images', 'thumb') }}" class="m-auto"></div>
        <div class="ms-2">{{$post->text}}</div>
        </a>
    </div></div>
    @endforeach
    <a href="{{route('posts.create')}}" class="text-decoration-none h5 btn btn-primary link-white m-4" style="width: fit-content;">Create post</a>

</div>
<br/>
<p class="h4 m-4">Your comments</p>
<div class="card p-5 d-flex justify-content-center m-4">
    @foreach($comments as $comment)
    <div class="d-flex justify-content-center flex-row">
    <div class="m-4 card p-5" style="width: 100%;"><a href="{{route('comments.show',
                                                   ['comment'=>$comment])}}" class="text-decoration-none h5 link-dark">{{$comment->text}}</a>
    </div></div>
    @endforeach
</div>
@endsection
