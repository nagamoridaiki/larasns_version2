
<div class="p-3 col-sm-6">
  <div class="card">

      <div class="view overlay">
        <img class="card-img-top" src="{{ asset($event->image) }}" 
          alt="Card image cap" width="800" height="300">
      </div>
      <div class="card-body">
        <a class="nav-link navbar-brand" href="{{ route('events.create') }}">
          <h4 class="card-title">{{$event->title}}</h4>
          <p class="card-text">{{$event->detail}}</p>
          <p class="mb-0 text-secondary">
            <span>主催者 &#064;{{$event->user->name}}</span>
          </p>
        </a>
      </div>
    
  </div>
</div>
