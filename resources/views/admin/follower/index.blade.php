@extends('layouts.app')
@section('title','Follower')

@section('content')
    <div class="container">
        <div class="row">
            @foreach(Auth::user()->followers as $follower)
            <div class="col-lg-3">
                <div class="card">
                    @if($follower->follower->image)
                        <img src="{{asset('storage/'.$follower->follower->image)}}" class="card-img-top">
                    @else       
                        <div class="card-header">
                            tidak memiliki gambar
                        </div>
                    @endif
                    <div class="card-body">
                        <h2>{{$follower->follower->name}}</h2>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection