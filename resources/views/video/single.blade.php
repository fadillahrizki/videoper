@extends('layouts.app')
@section('title',$video->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <video src="{{asset('storage/'.$video->file)}}" controls width="100%">
            Your Browser does not support the video tag
            </video>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="d-flex justify-content-between pt-3"><b>{{$video->title}} </b><span>{{($video->views > 0 ? $video->views.'x Dilihat' : 'Belum dilihat')}}</span></h2>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                <h4>Description</h4>
                    <p>{{$video->description}}</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Comments</h4>
                    @if(Auth::user())
                    <form action="{{route('comment')}}" method="post">
                    @csrf
                        <input type="hidden" name="video_id" value="{{$video->id}}">
                        <textarea name="text" rows="5" class="form-control">your comment..</textarea>
                        <hr>
                        <button class="btn btn-secondary">Comment</button>
                    </form>
                    @else
                        <a href="{{route('login')}}" class="btn btn-secondary">Login untuk comment</a>
                    @endif
                    <hr>
                    @foreach($video->comments as $comment)
                    <?php $date = date('d-m-Y',strtotime($comment->created_at)) ?>
                        <p class="m-0 d-flex justify-content-between">
                            <b>{{$comment->user->name}}</b>
                            <span>{{$date}}</span>
                        </p>
                        <p class="d-flex justify-content-between">
                        {{$comment->text}}
                            @if(Auth::user() == $comment->user)
                                <a href="{{route('deleteComment',$comment->id)}}" class="badge badge-danger">delete</a>
                            @endif
                        </p>
                        
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Related Videos</h4>
                </div>
            </div>

            @foreach($videos as $vid)
                <div class="row mb-3">
                    <div class="col-lg-7">
                        <img src="{{asset('storage/'.$vid->thumbnail)}}" class="img-fluid">
                    </div>
                    <div class="col-lg-5">
                        <p class="m-0">{{$vid->user->name}}</p>
                        <a href="{{route('single',$vid->id)}}"><b>{{$vid->title}} </b></a>
                        <p class="m-0">{{($vid->views > 0 ? $vid->views.'x Dilihat' : 'Belum dilihat')}}</p>
                        <a href="{{route('single',$vid->id)}}" class="btn btn-success btn-sm">See More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection