@extends('layouts.app')
@section('title','Single App')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="{{route('videos.index')}}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <video src="{{asset('storage/'.$video->file)}}" controls width="100%">
            Your Browser does not support the video tag
            </video>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="d-flex justify-content-between pt-3">
                            <b>{{$video->title}} </b>
                            <span>{{($video->views > 0 ? $video->views.'x Dilihat' : 'Belum dilihat')}}</span>
                        </h4> 
                        <p>{{$video->description}}</p>
                        <a href="{{route('videos.update',$video->id)}}" class="btn btn-warning">Update</a>
                        <a href="{{route('videos.delete',$video->id)}}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection