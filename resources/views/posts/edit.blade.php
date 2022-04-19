@extends('layouts.app')
@section('title','Create comment')
@section('content')
<div class="h4 m-4">Edit this post!</div>
<form method="POST" action="{{route('posts.update',['post'=>$post])}}" enctype="multipart/form-data">
@method('PUT')

@csrf
@error('title')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
<div class="m-3">
<p class="h5">The title of your post: <input type="title" name="title" class="form-control" style="width:20%;" value="{{$post->title}}"></p>
</div>
@error('text')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
<div class="m-3">
<p class="h5">Text: <textarea type="text" name="text" class="form-control" style="width:20%;" value="{{old('text')}}">{{$post->text}}</textarea></p></div>

<div class="m-3">
                            <label for="post_image" class="h5">{{ __('Post Image (optional):') }}</label>

                                 <div class="col-md-6">
                                      <input type="file" class="form-control" name="post_image" id="post_image">
                                 </div>
                            </div>
                            <img src="{{$post->getFirstMediaUrl('post_images', 'thumb') }}" class="m-auto">
<div class="m-3"><input type="submit" value="Submit" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">
<a href="{{route('posts.show',['post'=>$post])}}" class="text-decoration-none h5 btn btn-primary link-white" style="width: fit-content;">Cancel</a>
</div>
</form>
@endsection
