@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<h4 class="display-2 text-black text-center m-5">Welcome to the home page of this forum!</h1>
<div class="m-5">
<div class="ml-2 h2">Here are the posts you can find on this blog!</div>
<div class="card p-5 d-flex justify-content-center" style="width: 100%;">
    @foreach($posts as $post)
    <div class="d-flex justify-content-center flex-row">
    <div class="m-4 card p-5" style="width: 100%;"><a class="text-decoration-none h5 link-dark" href="{{route('posts.show',['post'=>$post])}}">
        <div class="mb-4 h3">{{$post->title}}</div>
        <div class="ms-2">{{$post->text}}</div>
        </a>
    </div></div>
    @endforeach
    @if(Auth::check())
    <a href="{{route('posts.create')}}" class="text-decoration-none h5 btn btn-primary link-white m-4" style="width: fit-content;">Create post</a>

         @endif
</div>
</div>
@endsection
