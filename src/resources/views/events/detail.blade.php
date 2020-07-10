@extends('app')

@section('title', 'イベント作成')

@include('nav')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9 mb-3">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="view">
                                <img class="card-img-top" src="{{ asset($event->image) }}" 
                                    alt="Card image cap">
                                <a href="#">
                                <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{$event->title}}</h4>
                                <p class="card-text">{{$event->detail}}</p>
                                <p class="mb-0 text-secondary">
                                    <span>主催者 &#064;{{$event->user->name}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection