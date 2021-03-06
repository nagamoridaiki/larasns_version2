@extends('app')

@section('title', 'イベント作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @include('events.form')
                <button type="submit" class="btn blue-gradient btn-block">イベントを作成する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection