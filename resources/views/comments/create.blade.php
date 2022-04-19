@extends('layouts.app')
@section('title','Create comment')
@section('content')
<div class="h4 m-4">Leave a comment</div>
<form method="POST" action="{{route('comments.store', ['post'=>$post])}}">
@csrf
@error('text')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
<div class="m-3">
<p class="h5">Text: <textarea type="text" name="text" class="form-control" style="width:20%;" value="{{old('text')}}"></textarea></p>
<input type="submit" value="Submit" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">
<a href="{{route('posts.show', ['post'=>$post])}}" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">Cancel</a>
</div>
</form>
@endsection
