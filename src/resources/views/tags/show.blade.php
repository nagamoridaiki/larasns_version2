@extends('app')

@section('title', $tag->hashtag)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="barchart">
          <bar-chart :tag='@json($tag->name)'></bar-chart>
        </div>
        <div class="card-text text-right">
        </div>
      </div>
    </div>
    @foreach($tag->articles as $article)
      @include('articles.card')
    @endforeach
  </div>
@endsection

<style>
.barchart{
  width: 50%;
  height:30%;
}
</style>