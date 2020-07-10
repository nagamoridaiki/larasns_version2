@extends('app')

@section('title', 'イベント作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
    @foreach($events as $event)
      @include('events.component')
    @endforeach
    </div>
  </div>
@endsection
