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
                                    <span>会場 &#064;{{$event->address}}</span>
                                </p>
                                <p class="mb-0 text-secondary">
                                    <span>主催者 ：{{$event->user->name}}</span>
                                </p>
                                <p class="mb-0 text-secondary">
                                    <span>料金 ：{{$event->price}}円</span>
                                </p>
                            </div>
                            @foreach($event->tags as $tag)
                                @if($loop->first)
                                <div class="card-body pt-0 pb-4 pl-3">
                                    <div class="card-text line-height">
                                @endif
                                    {{ $tag->hashtag }}
                                @if($loop->last)
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection