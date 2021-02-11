@if ($banners->count() > 0)
<div class="combo-home container-fluid">
  <img src="{{$banners->first()->imagen_web_url}}" class="mx-auto img-fluid combo-desktop" alt="Combo Home">
</div>
@endif
