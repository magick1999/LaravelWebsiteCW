@extends('layouts.app')
@section('title','Create comment')
@section('content')
<div class="h4 m-4">Edit this comment!</div>
<form method="POST" action="{{route('comments.update',['comment'=>$comment])}}">
@method('PUT')
@csrf
@error('text')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
<div class="m-3">
<p class="h5">Text: <textarea type="text" name="text" class="form-control" style="width:20%;" value="{{old('text')}}">{{$comment->text}}</textarea></p></div>
<div class="m-3"><input type="submit" value="Submit" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">
<a href="{{route('comments.show',['comment'=>$comment])}}" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">Cancel</a>
</div>
</form>
@endsection
