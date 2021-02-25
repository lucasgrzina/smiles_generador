<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/


Route::prefix('id')->group(function () {
    Route::get('/clear/{type}', 'IDController@clear');
    Route::get('/send-email', 'IDController@sendEmail');
});

Route::prefix('test')->group(function () {
    //Route::get('/sms', 'TestController@sms');
});

Route::prefix('combos')->group(function () {
    Route::post('/retails', 'CombosController@retails')->name('combo.retails');
    Route::post('/sucursales', 'CombosController@sucursales')->name('combo.sucursales');
    //Route::get('/vendedores', 'CombosController@vendedores')->name('combo.vendedores');
    //Route::get('/proveedores', 'CombosController@proveedores')->name('combo.proveedores');
});

Route::prefix('exportar')->group(function () {
    Route::get('/', 'Admin\ExportController@export')->name('export.general');
});

/*Uploads*/
Route::prefix('uploads')->group(function () {
    Route::post('/file', 'UploadsController@storeFile')->name('uploads.store-file');
    Route::post('/image', 'UploadsController@storeImage')->name('uploads.store-image');
});

/*Admin*/
Route::prefix('/admin')->group(function () {
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');

    Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.reset.post');
    Route::get('/password/email', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.email');
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.email.post');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

        Route::post('usuarios/change-enabled', 'Admin\UserController@changeEnabled')->name('usuarios.change-enabled');
        Route::post('usuarios/filter', 'Admin\UserController@filter')->name('usuarios.filter');
        Route::get('usuarios/exportar/{type}', 'Admin\UserController@export')->name('usuarios.export');
        Route::put('usuarios/{id}/guardar-permisos', 'Admin\UserController@guardarPermisos')->name('usuarios.guardar-permisos');
        Route::get('usuarios/{id}/editar-permisos', 'Admin\UserController@editarPermisos')->name('usuarios.editar-permisos');

        Route::resource('usuarios', 'Admin\UserController');

        Route::post('roles/filter', 'Admin\RoleController@filter')->name('roles.filter');
        Route::resource('roles', 'Admin\RoleController');

        Route::get('/registrados/rechazados-a-pendientes', 'Admin\RegistradoController@rechazadosAPendientes')->name('registrados.rechazados-a-pendientes');
        Route::post('registrados/change-enabled', 'Admin\RegistradoController@changeEnabled')->name('registrados.change-enabled');
        Route::post('registrados/filter', 'Admin\RegistradoController@filter')->name('registrados.filter');
        Route::post('registrados/enable-registered', 'Admin\RegistradoController@enableRegistered')->name('registrados.enable-registered');
        Route::resource('registrados', 'Admin\RegistradoController');

        Route::post('paises/change-enabled', 'Admin\PaisesController@changeEnabled')->name('paises.change-enabled');
        Route::post('paises/filter', 'Admin\PaisesController@filter')->name('paises.filter');
        Route::resource('paises', 'Admin\PaisesController');

        Route::get('custom-mails/edit/{id}', 'Admin\CustomMailsController@index')->name('custom-mails.edit-lang');            
        Route::post('custom-mails/change-enabled', 'Admin\CustomMailsController@changeEnabled')->name('custom-mails.change-enabled');
        Route::post('custom-mails/filter', 'Admin\CustomMailsController@filter')->name('custom-mails.filter');
        Route::resource('custom-mails', 'Admin\CustomMailsController');

        Route::get('contenido-predefinidos/edit/{id}', 'Admin\ContenidoPredefinidoController@index')->name('contenido-predefinidos.edit-lang');            
        Route::post('contenido-predefinidos/change-enabled', 'Admin\ContenidoPredefinidoController@changeEnabled')->name('contenido-predefinidos.change-enabled');
        Route::post('contenido-predefinidos/filter', 'Admin\ContenidoPredefinidoController@filter')->name('contenido-predefinidos.filter');
        Route::resource('contenido-predefinidos', 'Admin\ContenidoPredefinidoController');


        Route::get('retails/sucursales/{parentId}', 'Admin\RetailsSucursalesController@index')->name('retailsSucursales.index');
        Route::get('retails/sucursales/{parentId}/create', 'Admin\RetailsSucursalesController@create')->name('retailsSucursales.create');
        Route::post('retails/sucursales/{parentId}/store', 'Admin\RetailsSucursalesController@store')->name('retailsSucursales.store');
        Route::get('retails/sucursales/{parentId}/{id}/edit', 'Admin\RetailsSucursalesController@edit')->name('retailsSucursales.edit');
        Route::put('retails/sucursales/{id}/update', 'Admin\RetailsSucursalesController@update')->name('retailsSucursales.update');
        Route::get('retails/sucursales/{parentId}/{id}/show', 'Admin\RetailsSucursalesController@show')->name('retailsSucursales.show');
        Route::delete('retails/sucursales/{id}/destroy', 'Admin\RetailsSucursalesController@destroy')->name('retailsSucursales.destroy');
        Route::post('retails/sucursales/change-enabled', 'Admin\RetailsSucursalesController@changeEnabled')->name('retailsSucursales.change-enabled');
        Route::post('retails/sucursales/{parentId}/filter', 'Admin\RetailsSucursalesController@filter')->name('retailsSucursales.filter');



        Route::post('retails/change-enabled', 'Admin\RetailsController@changeEnabled')->name('retails.change-enabled');
        Route::post('retails/filter', 'Admin\RetailsController@filter')->name('retails.filter');

        Route::get('retails/{id}/importar-sucursales', 'Admin\RetailsController@importarSucursales')->name('retails.importar-sucursales');
        Route::post('retails/{id}/importar-sucursales', 'Admin\RetailsController@importarArchivo')->name('retails.importar-archivo');
        
        Route::get('retails/{id}/objetivos', 'Admin\RetailsController@objetivos')->name('retails.objetivos');
        Route::put('retails/{id}/objetivos', 'Admin\RetailsController@guardarObjetivos')->name('retails.guardar-objetivos');
        Route::resource('retails', 'Admin\RetailsController');

        Route::post('sucursales/change-enabled', 'Admin\SucursalesController@changeEnabled')->name('sucursales.change-enabled');
        Route::post('sucursales/filter', 'Admin\SucursalesController@filter')->name('sucursales.filter');
        Route::resource('sucursales', 'Admin\SucursalesController');   

        Route::post('banners/change-enabled', 'Admin\BannersController@changeEnabled')->name('banners.change-enabled');
        Route::post('banners/filter', 'Admin\BannersController@filter')->name('banners.filter');
        Route::resource('banners', 'Admin\BannersController');
          
        Route::post('noticias/change-enabled', 'Admin\NoticiasController@changeEnabled')->name('noticias.change-enabled');
        Route::post('noticias/filter', 'Admin\NoticiasController@filter')->name('noticias.filter');
        Route::resource('noticias', 'Admin\NoticiasController');
           
        Route::post('entrenamientos/change-enabled', 'Admin\entrenamientosController@changeEnabled')->name('entrenamientos.change-enabled');
        Route::post('entrenamientos/filter', 'Admin\entrenamientosController@filter')->name('entrenamientos.filter');
        Route::resource('entrenamientos', 'Admin\entrenamientosController');
 
                   
        Route::post('categorias/change-enabled', 'Admin\categoriasController@changeEnabled')->name('categorias.change-enabled');
        Route::post('categorias/filter', 'Admin\categoriasController@filter')->name('categorias.filter');
        Route::resource('categorias', 'Admin\categoriasController');

        Route::post('ofertas/change-enabled', 'Admin\ofertasController@changeEnabled')->name('ofertas.change-enabled');
        Route::post('ofertas/filter', 'Admin\ofertasController@filter')->name('ofertas.filter');
        Route::resource('ofertas', 'Admin\ofertasController');
         
        Route::post('contenidos/change-enabled', 'Admin\ContenidosController@changeEnabled')->name('contenidos.change-enabled');
        Route::post('contenidos/filter', 'Admin\ContenidosController@filter')->name('contenidos.filter');
        Route::resource('contenidos', 'Admin\ContenidosController');
          
        Route::post('ofertas-opiniones/change-enabled', 'Admin\OfertasOpinionesController@changeEnabled')->name('ofertas-opiniones.change-enabled');
        Route::post('ofertas-opiniones/filter', 'Admin\OfertasOpinionesController@filter')->name('ofertas-opiniones.filter');
        Route::resource('ofertas-opiniones', 'Admin\OfertasOpinionesController');

        Route::post('premios/change-enabled', 'Admin\PremiosController@changeEnabled')->name('premios.change-enabled');
        Route::post('premios/filter', 'Admin\PremiosController@filter')->name('premios.filter');
        Route::resource('premios', 'Admin\PremiosController');

        Route::post('productos/change-enabled', 'Admin\ProductosController@changeEnabled')->name('productos.change-enabled');
        Route::post('productos/filter', 'Admin\ProductosController@filter')->name('productos.filter');
        Route::resource('productos', 'Admin\ProductosController');        

        Route::post('mecanicas/change-enabled', 'Admin\MecanicasController@changeEnabled')->name('mecanicas.change-enabled');
        Route::post('mecanicas/filter', 'Admin\MecanicasController@filter')->name('mecanicas.filter');
        Route::resource('mecanicas', 'Admin\MecanicasController');

        Route::post('contactos/change-enabled', 'Admin\ContactosController@changeEnabled')->name('contactos.change-enabled');
        Route::post('contactos/filter', 'Admin\ContactosController@filter')->name('contactos.filter');
        Route::resource('contactos', 'Admin\ContactosController');

        Route::post('alertas/change-enabled', 'Admin\AlertasController@changeEnabled')->name('alertas.change-enabled');
        Route::post('alertas/filter', 'Admin\AlertasController@filter')->name('alertas.filter');
        Route::resource('alertas', 'Admin\AlertasController');    
      
        Route::post('ventas/change-enabled', 'Admin\VentasController@changeEnabled')->name('ventas.change-enabled');
        Route::post('ventas/filter', 'Admin\VentasController@filter')->name('ventas.filter');
        Route::resource('ventas', 'Admin\VentasController');    

        Route::post('materiales/change-enabled', 'Admin\MaterialesController@changeEnabled')->name('materiales.change-enabled');
        Route::post('materiales/filter', 'Admin\MaterialesController@filter')->name('materiales.filter');
        Route::resource('materiales', 'Admin\MaterialesController');        

        Route::post('tags/change-enabled', 'Admin\TagsController@changeEnabled')->name('tags.change-enabled');
        Route::post('tags/filter', 'Admin\TagsController@filter')->name('tags.filter');
        Route::resource('tags', 'Admin\TagsController');

        //Route::get('clientes/importar', 'Admin\ClientesController@importar')->name('clientes.importar');
        //Route::post('clientes/importar', 'Admin\ClientesController@importarArchivo')->name('clientes.importar-archivo');
        //Route::post('clientes/change-enabled', 'Admin\ClientesController@changeEnabled')->name('clientes.change-enabled');
        //Route::post('clientes/filter', 'Admin\ClientesController@filter')->name('clientes.filter');
        //Route::resource('clientes', 'Admin\ClientesController');

        Route::get('clear-cache', function () {
            $exitCode = Artisan::call('cache:clear');
            echo 'done';// return what you want
        })->name('clear-cache');

        Route::get('/error/{code}', 'Admin\ErrorController@index')->name('admin.error');

        
        
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.home');
       
    });
});

Route::get('/log/obtener', function () {
    if (env('APP_ENV', 'local') === 'local') {
        $pathToFile = storage_path() . '\logs\laravel.log';
    } else {
        $pathToFile = storage_path() . '/logs/laravel.log';
    }

    return response()->download($pathToFile, 'laravel.log');
});
Route::get('/log/borrar', function () {
    if (env('APP_ENV', 'local') === 'local') {
        $pathToFile = storage_path() . '\logs\laravel.log';
    } else {
        $pathToFile = storage_path() . '/logs/laravel.log';
    }

    unlink($pathToFile);
    return 'Listo.';
});

Route::prefix('mailing/respaldo')->group(function () {
    Route::get('/registro/{guid}', 'Front\MailingRespaldoController@registro')->name('mailingRespaldo.registro');
});


if (request()->segment(1) !== 'admin') {
    $locale = '';
    
    //me fijo por el primer segmento de la URL que pais quiere ver

    if (strlen(request()->segment(1)) === 2) {
        $locale = request()->segment(1);
    } else {
        $locale = 'co';
    }    
        
    Route::middleware([])->group(function () {
        Route::get('/', 'Front\HomeController@index')->name('home');
        
        Route::middleware(['guest'])->group(function () {
            Route::get('/confirmar-cuenta/{guid}', 'Front\MiCuentaController@confirmarCuenta')->name('confirmarCuenta');
            Route::get('/login', 'Front\MiCuentaController@login')->name('login');
            Route::post('/login', 'Auth\LoginController@login')->name('login-post');
            Route::get('/registro', 'Front\MiCuentaController@registro')->name('registro');
            Route::post('/registro', 'Auth\RegisterController@register')->name('registro-post');
        
        }); 
        Route::middleware(['auth'])->group(function () {
            
            Route::get('/cambiar-contrasena', 'Front\CambiarContrasenaController@index')->name('cambiarContrasena'); 
            Route::post('/cambiar-contrasena/guardar', 'Front\CambiarContrasenaController@guardar')->name('cambiarContrasena.guardar');
            Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        });               
    });
    Route::post('/olvide-contrasena', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('olvide-password');
    //Route::get('/cambiar-contrasena', 'Front\MiCuentaController@cambiarPassword')->name('cambiar-password');
    
    

    Route::middleware(['auth'])->group(function () {    
        //Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        
        
        
        
        
        //Route::get('/materiales', 'Front\FrontController@materiales')->name('materiales');
        
        
        
    });        

}






