@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="container">
    <div class="row py-3">
        <div class="col-lg-10">
            <form action="{{route('search')}}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari video anda.." name="search" value="{{Request::get('search')}}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" >Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2">
            <form action="{{route('filter')}}" method="get">
                <div class="input-group">
                    <select name="filter" class="form-control">
                        <option value="">Filter</option>
                        <option value="1">Terbaru</option>
                        <option value="2">Terlama</option>
                        <option value="3">Paling Banyak Dilihat</option>
                        <option value="4">Paling Sedikit Dilihat</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success">Go</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if($videos->count())
    <div class="row">
        @foreach($videos as $vid)
            <div class="col-lg-4 mb-3">
                <div class="card">
                    <img src="{{asset('storage/'.$vid->thumbnail)}}" class="img-fluid">
                    <div class="card-body">
                        <span class="d-flex justify-content-between">
                            <b class="text-success">{{$vid->user->name}}</b>
                            <span class="text-success">{{$vid->user->followers()->count()}} followers</span>
                        </span>
                        <p class="d-flex justify-content-between"><b>{{$vid->title}}</b> <span>{{($vid->views > 0 ? $vid->views.'x Dilihat' : 'Belum dilihat')}}</span></p>
                        <a href="{{route('single',$vid->id)}}" class="btn btn-success">View More</a>
                        @if($vid->user->followers->count() && $vid->user->id != Auth::id())
                            @foreach($vid->user->followers as $follower)
                                @if(Auth::id() == $follower->followed_id)
                                    <button class="btn btn-secondary" disabled>Followed</button>
                                @else
                                <form action="{{route('admin.follow')}}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$vid->user->id}}">
                                    <button class="btn btn-outline-dark">Follow {{$vid->user->name}}</button>
                                </form>
                                @endif
                            @endforeach
                        @else
                            @if(Auth::id() == $vid->user->id)
                                <a href="{{route('admin.profile',Auth::id())}}" class="btn btn-outline-dark">See Your Account</a>
                            @else
                                <form action="{{route('admin.follow')}}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$vid->user->id}}">
                                    <button class="btn btn-outline-dark">Follow {{$vid->user->name}}</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach       
    </div>
    @else
    <div class="row">
        <div class="col-lg-12">
            <h2>Data tidak ditemukan</h2>
        </div>
    </div>
    @endif
</div>

@endsection