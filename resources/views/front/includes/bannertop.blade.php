@if ($banners->count() > 0)
<div id="carouselMicrosoft" class="carousel slide" data-ride="carousel">
  <div class="container">
    <ol class="carousel-indicators">
    @foreach ($banners as $i => $banner)
      <li data-target="#carouselMicrosoft" data-slide-to="{{$i}}" class="{{ $i === 0 ? 'active' : ''}}"></li>
    @endforeach
    </ol>
    <div class="carousel-inner">
    @foreach ($banners as $i => $banner)
      <div class="carousel-item active">
        <img src="{{$banner->imagen_web_url}}" class="d-block w-100" alt="...">
      </div>
    @endforeach	
    </div>
  </div>
</div>

<div id="carouselMicrosoft-mobile" class="carousel carousel-mobile slide" data-ride="carousel">
  <div class="container">
    <ol class="carousel-indicators">
    @foreach ($banners as $i => $banner)
      <li data-target="#carouselMicrosoft-mobile" data-slide-to="{{$i}}" class="{{ $i === 0 ? 'active' : ''}}"></li>
    @endforeach
    </ol>
    <div class="carousel-inner">
    @foreach ($banners as $i => $banner)
      <div class="carousel-item active">
        <img src="{{$banner->imagen_web_url}}" class="d-block w-100" alt="...">
      </div>
    @endforeach	
    </div>
  </div>
</div>		
@endif