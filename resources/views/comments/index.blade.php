@extends('layouts.app')
@section('title', 'comments')
@section('content')
<p>comments at Swansea Zoo</p>
<ul>
@foreach($comments as $comment)
<li><a href="{{route('comments.show',
['comment'=>$comment, 'post'=>$post])}}">{{$comment->text}}</a></li>
@endforeach
</ul>
@endsection
