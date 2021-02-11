@extends('layouts.front')
@section('scripts')
	@parent
    <script type="text/javascript">
		$("#navbars ul li a[href^='#']").on('click', function(e) {
  
			if ( $(this).hasClass("btn-cambiar-pass")) {
			console.log("Btn Cambiar Contraseña");
			} else if ( $(this).hasClass("btn-salir")) {
			console.log("Btn Salir");
			} else {
			// prevent default anchor click behavior
			e.preventDefault();
	
			// store hash
			var hash = this.hash;
	
			// animate
			$('html, body').animate({
				scrollTop: $(hash).offset().top
				}, 300, function(){
	
				// when done, add hash to url
				// (default click behaviour)
				window.location.hash = hash;
				});
			}
		});
	</script>    
  
	<script type="text/javascript">
		var _data = {!! json_encode($data) !!};
		
		_methods.cambiarPasswordSubmit = function() {
			var _this = this;
			var _registro = _this.cambiarPassword;
			var scope = 'frm-cc';
			var _errorMsg = null;
			
			if (_registro.enviando) {
				return false;
			}

			this.$validator.validateAll(scope).then(function() {
				
				_registro.enviando = true;
				_this._call(_registro.url_post,'POST',_registro.form).then(function(data) {
					//location.reload();
					alert(data.message);
					_registro.form.password = null;
					_registro.enviando = false;
					$('.close','#modalPassword').trigger('click');
				}, function(error) {
					if (error.status != 422) {
						_this.toastError(error.message);
					} else {
						var mensaje = [];
						_.forEach(error.data.errors, function(msj,campo) {
							mensaje.push(msj);
						});

						alert(mensaje.join('\n\r'));
					}
					_registro.enviando = false;
				});          
			
			}).catch(function(e) {
				_registro.enviando = false;
			});
		};	

		_methods.guardarContactoSubmit = function() {
			var _this = this;
			var _registro = _this.guardarContacto;
			var scope = 'frm-gc';
			var _errorMsg = null;
			
			if (_registro.enviando) {
				return false;
			}

			this.$validator.validateAll(scope).then(function() {
				
				_registro.enviando = true;
				_this._call(_registro.url_post,'POST',_registro.form).then(function(data) {
					//location.reload();
					alert('Gracias por dejar tu contacto');
					_registro.form.mensaje = null;
					_registro.enviando = false;
				}, function(error) {
					if (error.status != 422) {
						alert(error.message);
					} else {
						var mensaje = [];
						_.forEach(error.data.errors, function(msj,campo) {
							mensaje.push(msj);
						});

						alert(mensaje.join('\n\r'));
					}
					_registro.enviando = false;
				});          
			
			}).catch(function(e) {
				_registro.enviando = false;
			});
		};			

        this._mounted.push(function(_this) {
            console.debug(_this);
        });

        var loginPage = true;
	</script>
@endsection
@section('content')
	@php
		//$bannersTop = $data['banners']->where('tipo','T');
		//$bannersBottom = $data['banners']->where('tipo','B');
	@endphp

	@include('front.includes.bannertop', ['banners' => $data['banners']->where('tipo','T')])

	<div class="container-fluid no-padding inicio-cuadros">
		<div class="container">
		<div class="row">
			<div class="col-lg mr-2 cont-microsoft cont-microsoft-01">
			<img src="img/tips.jpg" class="mx-auto img-fluid w-100 d-block img-001" alt="Target-01">
			<div class="cont-tablet">
				<h3>Tip del mes</h3>
				<p>Conoces los últimos tips para ofrecer el Office adecuado a tus clientes?</p>
				<a href="#" class="btn btn-microsoft btn-microsoft-01" tabindex="-1" role="button">VER MÁS</a>
			</div>
			</div>
			<div class="col-lg mr-2 ml-2 cont-microsoft cont-microsoft-02">
			<img src="img/potencia-tus-mensajes.jpg" class="mx-auto img-fluid w-100 d-block img-001" alt="Target-02">
			<div class="cont-tablet">
				<h3>Potencia tus mensajes</h3>
				<p>Nuevos materiales de venta de Office y Windows para que uses en tus redes sociales</p>
				<a href="#" class="btn btn-microsoft btn-microsoft-02" tabindex="-1" role="button">VER MÁS</a>
			</div>
			</div>
			<div class="col-lg ml-2 cont-microsoft cont-microsoft-03">
			<img src="img/beneficios.jpg" class="mx-auto img-fluid w-100 d-block" alt="Target-03">
			<div class="cont-tablet">
				<h3>Beneficios</h3>
				<p>Hay descuentos exclusivos esperándote para que ahorres por ser nuestro socio.</p>
				<a href="#" class="btn btn-microsoft btn-microsoft-03" tabindex="-1" role="button">VER MÁS</a>
			</div>
			</div>
		</div>
		</div>
	</div>

	@include('front.includes.bannerbottom', ['banners' => $data['banners']->where('tipo','B')])

@endsection
@section('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection