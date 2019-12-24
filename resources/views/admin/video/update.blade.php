@extends('layouts.app')
@section('title','Update Video')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="{{route('videos.update',$video->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <input type="text" class="form-control" name="title" value="{{$video->title}}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <textarea name="description" rows="10" class="form-control">{{{$video->description}}}</textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    @error('thumbnail')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <img src="{{asset('storage/'.$video->thumbnail)}}" class="img-fluid">
                    <div class="custom-file">
                        <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Choose file</label>
                    </div>
                </div>
                <button class="btn btn-success">Update Video</button>
            </form>
        </div>
    </div>
</div>
@endsection