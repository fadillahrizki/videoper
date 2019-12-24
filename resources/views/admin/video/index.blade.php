@extends('layouts.app')

@if(Request::url() == route('videos.index'))
    @section('title','Home')
@else
    @section('title','Search')
@endif

@section('content')
<div class="container">
    <div class="row py-3">
        <div class="col-lg-10">
            <form action="{{route('videos.search')}}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari video anda.." name="search" value="{{Request::get('search')}}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" >Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2">
            <a href="{{route('videos.create')}}" class="btn btn-success btn-block">Buat Video Baru</a>
        </div>
    </div>
    @if($videos->count())
    <div class="row">
        @foreach($videos as $video)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="{{asset('storage/'.$video->thumbnail)}}" class="img-fluid">
                    <div class="card-body">
                        <p class="d-flex justify-content-between"><b>{{$video->title}}</b> <span>{{($video->views > 0 ? $video->views.'x Dilihat' : 'Belum dilihat')}}</span></p>
                        <a href="{{route('videos.single',$video->id)}}" class="btn btn-success">View More</a>
                        <span class="btn btn-dark">Comments ({{$video->comments()->count()}})</span>
                    </div>
                </div>
            </div>
        @endforeach 
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
            {{$videos->links()}}
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12">
            <h2>Video tidak ditemukan</h2>
        </div>
    </div>
    @endif 
</div>

@endsection