@extends('layouts.app')
@section('title','Create post')
@section('content')
<form method="POST" action="{{route('posts.store')}}">
@csrf
@error('title')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
<p>Name: <input type="text" name="title" value="{{old('title')}}"></p>
@error('text')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
<p>email: <input type="text" name="text" value="{{old('text')}}"></p>
<input type="submit" value="Submit">
<a href="{{route('posts.index')}}">Cancel</a>
</form>
@endsection
