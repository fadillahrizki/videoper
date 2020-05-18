@extends('layouts.app')
@section('title','Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    @if($user->image == null)
                        
                            <form action="{{route('admin.addImage')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <button class="btn btn-success btn-block">Tambah Gambar</button>
                            </form>
                        
                    @else
                        <img src="{{asset('storage/'.$user->image)}}" class="img-fluid rounded">
                    @endif
                        <?php 
                            $time = strtotime($user->created_at);
                            $date = date("d-m-Y",$time);
                        ?>
                        <div class="my-3">
                            <div class="d-flex justify-content-between">
                                <h4>{{$user->name}}</h4> 
                                <span class="text-success">{{$user->followers->count()}} followers</span>
                            </div>
                            <h5>{{$user->email}}</h5>
                            <p class="d-flex justify-content-between">Tanggal Mendaftar <span>{{$date}}</span></p>
                        </div>

                        @if($user->followers->count() && Auth::id() != $user->id)
                            @foreach($user->followers as $follower)
                                @if(Auth::id() == $follower->followed_id)
                                    <button class="btn btn-secondary" disabled>Followed</button>
                                @else
                                    <form action="{{route('admin.follow')}}" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button class="btn btn-outline-dark">Follow {{$user->name}}</button>
                                    </form>
                                @endif
                            @endforeach
                        @else
                            @if(Auth::id() != $user->id)
                                <form action="{{route('admin.follow')}}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    <button class="btn btn-outline-dark btn-block">Follow {{$user->name}}</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3">
                        <h4>{{$user->name}}'s Videos</h4>
                        <hr style="border:2px solid #999;border-radius:8px;">
                    </div>
                    <div class="col-lg-4">
                        <form action="{{route('admin.search',$user->id)}}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @if($user->videos->count())
                        @foreach($user->videos as $vid)
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
                                    </div>
                                </div>
                            </div>
                        @endforeach     
                    @else
                        <div class="col-lg-12">
                            <h4>Tidak ada video</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection