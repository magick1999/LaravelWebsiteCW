@extends('layouts.app')
@section('title','Post Details')
@section('content')
<div class="card m-4 p-4">
<div class="h4 mb-4">Comment by: {{$user->name}}</div>
<div class="h5">text: {{$comment->text}}</div>
<div class="d-flex flex-row">
@if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->id == $user->id))
@if(Auth::user()->id == $user->id)
     <a href="{{route('comments.edit',['comment'=>$comment])}}" class="text-decoration-none h5 btn btn-primary link-white me-2">Edit comment</a>
@endif
     <form method="POST"
     action="{{route('comments.destroy', ['comment'=>$comment, 'post'=>$post])}}">
     @csrf
     @method('DELETE')
     <button type="submit" class="text-decoration-none h5 btn btn-primary link-white me-2" style="width: fit-content;">Delete</button>
     </form>
     @endif
     <a href="{{route('posts.show', ['post'=>$post])}}" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">Back</a></div>

</div>


@endsection
