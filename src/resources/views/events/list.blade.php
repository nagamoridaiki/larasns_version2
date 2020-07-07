@extends('app')

@section('title', 'イベント作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
    イベントリストページ
    @foreach($events as $event)
      {{ $event->detail }}
    @endforeach
    </div>
  </div>
@endsection
