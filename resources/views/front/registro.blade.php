@extends('layouts.front')
@section('scripts')
	@parent
	<script type="text/javascript">
		var _data = {!! json_encode($data) !!};

		_methods.registroSubmit = function() {
			var _this = this;
			var _registro = _this.registro;
			var scope = 'frm-registro';
			var _errorMsg = null;
			
			//_registro.enviado = true;
			this.$validator.validateAll(scope).then(function() {
				
				_registro.enviando = true;
				_this._call(_registro.url_post,'POST',_registro.form,true,_this.errors,scope).then(function(data) {
					console.debug(data);
					//location.reload();
					//alert('Recibirás un correo con los pasos para activar tu cuenta.')
					//document.location = '{{routePais('login')}}';
					_registro.subtituloSeccion = 'Hemos recibido tus datos exitosamente.';
					_registro.enviando = false;
					_registro.enviado = true;
				}, function(error) {
					if (error.status != 422) {
						alert(error.message);
					} else {
						var mensaje = [];
						_.forEach(error.data.errors, function(msj,campo) {
							mensaje.push(msj);
						});

						alert(mensaje.join('\n\r'));
						/*error.data.errors. {
							alert(error.data.errors.email[0]);
						}*/
					}
					_registro.enviando = false;
				});          
			
			}).catch(function(e) {
			_registro.enviando = false;
			});
		};
		
		_methods.alCambiar = function(campo) {
			var _this = this;
			var _errorMsg = null;
			var _url = null;
			var _data = [];
			var _valorCampo = null;
			
			if (_this.registro.enviando) {
				return false;
			}
				
			_valorCampo = _this.registro.form[campo];

			if (campo === 'pais_id') {
				 
				//_this.registro.form.retail_id = null;
				//_this.registro.form.sucursal_id = null;

				//_url = '{{route("combo.retails")}}';
				_data = {
					pais_id: _valorCampo
				};

				//_this.$set(_this.registro.info,'retails',[]);
				//_this.$set(_this.registro.info,'sucursales',[]);
			} else {
				_this.registro.form.sucursal_id = null;

				_url = '{{route("combo.sucursales")}}';
				_data = {
					retail_id: _valorCampo
				};

				_this.$set(_this.registro.info,'sucursales',[]);
			}

			if (_valorCampo) {
				_this.registro.enviando = true;
				_this._call(_url,'POST',_data).then(function(data) {
					console.debug(data);
					if (campo === 'pais_id') {
						_this.$set(_this.registro.info,'retails',data);
					} else {
						_this.$set(_this.registro.info,'sucursales',data);
					}
					_this.registro.enviando = false;
				}, function(error) {
					_this.registro.enviando = false;
				});          

			}
			
		};		

        this._mounted.push(function(_this) {
            console.debug(_this);
        });

        var registroPage = true;
	</script>
@endsection
@section('css')
<link href="{{ asset('css/registro.css') }}" rel="stylesheet">
<link href="{{asset('css/gracias-registro.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid header-top">
	      <h1 class="h1 mb-1">Registro</h1>
	      <h2 class="h2 mb-0 font-weight-normal" v-html="registro.subtituloSeccion"></h2>
	    </div>
	  <div class="container" v-if="!registro.enviado">
		<form class="form-signin" v-on:submit.prevent="registroSubmit()" data-vv-scope="frm-registro">
			<label for="cliente" class="sr-only">Número de cliente de Intcomex</label>
	        <input type="text" id="cliente" class="form-control" placeholder="Número de cliente de Intcomex"
	        v-model="registro.form.cliente_intcomex" autofocus>
	        <label for="empresa" class="sr-only">Nombre de Empresa</label>
	        <input type="text" id="empresa" class="form-control" placeholder="Nombre de Empresa" v-model="registro.form.empresa" required>

		  	<label for="nombre" class="sr-only">Nombre</label>
		  	<input type="text" id="nombre" class="form-control" placeholder="Nombre" required autofocus v-model="registro.form.nombre">
		  	<label for="apellido" class="sr-only">Apellido</label>
		  	<input type="text" id="apellido" class="form-control" placeholder="Apellido" required v-model="	registro.form.apellido">
		  	<label for="inputEmail" class="sr-only">Email address</label>
		  	<input type="email" id="inputEmail" class="form-control" placeholder="Email" required v-model="registro.form.email">
		  	<label for="inputPassword" class="sr-only">Password</label>
		  	<input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required v-model="registro.form.password">
		  	<label for="pais" class="sr-only">País</label>
		  <select id="inputPais" class="form-control" v-model="registro.form.pais_id" required :disabled="true">
			<option :value="null">País</option>
			<option v-for="item in registro.info.paises" :value="item.id">(% item.nombre %)</option>
		  </select>
		  	<label for="inputTelFijo" class="sr-only">Número telefónico fijo</label>
        	<input type="number" id="inputTelFijo" class="form-control" placeholder="Número telefónico fijo" v-model="registro.form.telefono_fijo" required>
        	<label for="inputTelCelu" class="sr-only">Número telefónico celular</label>
        	<input type="number" id="inputTelCelu" class="form-control" placeholder="Número telefónico celular" v-model="registro.form.telefono_celular" required>
		  <button class="btn btn-lg btn-001 btn-block" type="submit" :disabled="registro.enviando">
		  	<span v-if="registro.enviando"></span>ENVIAR DATOS
		  </button>
		</form>
	  </div>
	  <div class="container-text" v-else>
		<p>En los próximos minutos validaremos los datos de registro y enviaremos un email a tu casilla de correo. Si no encuentras el email en la bandeja de entrada, por favor chequea en la bandeja de correo no deseado y spam.</p>
		<p>Si tienes alguna duda o consulta, nos puedes escribir a <a href="mailTo:contacto@nombredeldominio.com">contacto@nombredeldominio.com</a></p>
		<p>¡Muchas gracias!</p>
	  </div>	  

@endsection