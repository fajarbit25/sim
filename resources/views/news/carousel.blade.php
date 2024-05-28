<div class="carousel-indicators">
    @foreach($banner as $bnr)
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->iteration-1}}" class="@if($loop->iteration == 1) active @endif bg-warning" aria-current="true" aria-label="Slide {{$loop->iteration}}"></button>
    @endforeach
</div>

<div class="carousel-inner">
    @foreach($banner as $bnr)
    <div class="carousel-item @if($loop->iteration == 1) active @endif">
        <img src="{{asset('storage/home-banner/'.$bnr->foto)}}" class="d-block w-100" alt="banner-img">
    </div>
    @endforeach
</div>

<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-success" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-success" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>