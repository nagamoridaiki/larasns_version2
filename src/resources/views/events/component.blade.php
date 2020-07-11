
<div class="p-3 col-sm-6">
  <div class="card">

      <div class="view overlay">
        <img class="card-img-top" src="{{ asset($event->image) }}" 
          alt="Card image cap" width="800" height="300">
      </div>
      <div class="card-body">
        <a class="nav-link navbar-brand" href="{{ route('events.show', ['event' => $event]) }}">
          <h4 class="card-title">{{$event->title}}</h4>
          <p class="mb-0 text-secondary">
              <span>会場 &#064;{{$event->address}}</span>
          </p>
          <p class="mb-0 text-secondary">
            <span>主催者： {{$event->user->name}}</span>
          </p>
        </a>
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
