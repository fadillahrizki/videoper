@extends('layouts.app')
@section('title','Home Admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Selamat Datang di Halaman Admin, {{Auth::user()->name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-flex justify-content-between">Your Videos<span>{{Auth::user()->videos->count()}}</span></h3>
                        <a href="{{route('videos.index')}}" class="btn btn-success">View More</a>    
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-flex justify-content-between">Your Followers<span>{{Auth::user()->followers->count()}}</span></h3>
                        <a href="{{route('followers.index')}}" class="btn btn-success">View More</a>    
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-flex justify-content-between">Your Comments<span>{{Auth::user()->comments->count()}}</span></h3>
                        <a href="{{route('videos.index')}}" class="btn btn-success">View More</a>    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection