@extends('layouts.front')
@section('content')
  	 <div class="container-fluid header-top">
      <h1 class="h1 mb-1">Contacto</h1>
      <h2 class="h2 mb-0 font-weight-normal" v-html="subtituloSeccion"></h2>
    </div>
    <div class="container" v-if="!enviadoOk">
      <form class="form-signin" data-vv-scope="frm">
        <h2 class="h2 mb-0 font-weight-normal">Completa el siguiente campo.</h2>
        <textarea id="inputConsulta" class="form-control" placeholder="Consulta" rows="6" cols="60" required v-model="form.mensaje"></textarea>
        <button class="btn btn-lg btn-001" type="button" @click="enviar()" :disabled="enviando">ENVIAR</button>
      </form>
    </div>
    <div class="container-text" v-else>
      <p>Tu consulta fue enviada con éxito.</p>
      <p>A la brevedad nos pondremos en contacto contigo.</p>
      <p>¡Muchas gracias!</p>
    </div>



@endsection
@section('scripts')
	@parent
  
  
	<script type="text/javascript">
		var _data = {!! json_encode($data) !!};

		_methods.enviar = function() {
			var _this = this;
			var scope = 'frm';
			var _errorMsg = null;
			
			if (_this.enviando) {
				return false;
			}

			this.$validator.validateAll(scope).then(function() {
				
				_this.enviando = true;
				_this._call(_this.url_guardar,'POST',_this.form).then(function(data) {
          //location.reload();
          console.debug(data);
          _this.subtituloSeccion = 'Tu consulta fue enviada.';
          _this.enviadoOk = true;
					//alert('Gracias por dejar tu contacto');
					_this.form.mensaje = null;
					_this.enviando = false;
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
					_this.enviando = false;
				});          
			
			}).catch(function(e) {
				_this.enviando = false;
			});
		};			

    this._mounted.push(function(_this) {
        console.debug(_this);
    });

    var contactoPage = true;
	</script>
@endsection
@section('css')
 <!-- Custom styles for this template -->
    <link href="{{asset('css/contacto.css')}}" rel="stylesheet">
    <link href="{{asset('css/gracias-registro.css')}}" rel="stylesheet">
@endsection