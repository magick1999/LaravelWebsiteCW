@extends('layouts.app')
@section('title','User Details')
@section('content')
<ul>
<li>Name: {{$user->name}}</li>
<li>Weight: {{$user->email}}</li>
<li>Date of Birth: {{$user->password}}</li>
</ul>

<form method="POST"
action="{{route('users.destroy', ['user'=>$user])}}">
@csrf
@method('DELETE')
<button type="submit">Delete</button>
</form>

<a href="{{route('users.index')}}">Back</a>
@endsection
