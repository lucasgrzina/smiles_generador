@if(Auth::guest() || !config('constantes.homeActiva'))

    <div class="container">
      <div class="top-menu d-flex bd-highlight align-items-center ">
        <div class="pr-2 bd-highlight ishop"><a href="#"><img src="{{url('img/Logo-01.png')}}" alt="Target"></a></div>
        <div class="p-0 bd-highlight "><a href="#"><img src="{{url('img/Logo-02.png')}}" alt="Target"></a></div>
        <div class="tercer-logo-desktop ml-auto p-0 bd-highlight "><a href="{{routePais('home')}}"><img src="{{url('img/Logo-03.png')}}" alt="Target"></a></div>
      </div>
    </div>
    <nav class="navbar navbar-expand-xl navbar-ruta">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
        <div class="tercer-logo-mobile">
          <a href="{{routePais('home')}}">
            <img src="{{url('img/Logo-03-mobile.png')}}" alt="Target">
          </a>
        </div>
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbars">
        <div class="container">
          <ul class="navbar-nav mr-auto smooth-scroll">
            <li class="nav-item active">
              <a class="nav-link" href="{{routePais('login')}}">Iniciar sesión<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{routePais('registro')}}">Registrarse</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

@else
<div class="container">
      <div class="top-menu d-flex bd-highlight align-items-center ">
        <div class="pr-2 bd-highlight ishop"><a href="#"><img src="{{url('img/Logo-01.png')}}" alt="Target"></a></div>
        <div class="p-0 bd-highlight "><a href="#"><img src="{{url('img/Logo-02.png')}}" alt="Target"></a></div>
        <div class="tercer-logo-desktop ml-auto p-0 bd-highlight "><a href="{{routePais('home')}}"><img src="{{url('img/Logo-03.png')}}" alt="Target"></a></div>
      </div>
    </div>
     <nav class="navbar navbar-expand-xl navbar-ruta">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <div class="tercer-logo-mobile"><a href="#"><img src="{{url('img/Logo-03-mobile.png')}}" alt="Target"></a></div>
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbars">
            <div class="container">
              <ul class="navbar-nav mr-auto smooth-scroll">
                <li class="nav-item active">
                  <a class="nav-link" href="{{routePais('home')}}">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{routePais('entrenamiento')}}">Entrenamiento</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{routePais('ofertas')}}">Ofertas exclusivas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{routePais('materiales')}}">Materiales</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{routePais('contacto')}}">Contacto</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{routePais('cambiarContrasena')}}">Cambiar contraseña</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{routePais('logout')}}">Salir</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
@endif
