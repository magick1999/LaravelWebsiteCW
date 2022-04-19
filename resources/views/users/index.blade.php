@extends('layouts.app')
@section('title', 'Users')
@section('content')
<p>Users at Swansea Zoo</p>
<a href="{{route('users.create')}}">Create User</a>
<ul>
@foreach($users as $user)
<li><a href="{{route('users.show',
['user'=>$user])}}">{{$user->name}}</a></li>
@endforeach
</ul>
@endsection
