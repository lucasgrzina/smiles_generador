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
    Route::get('/leer-s3', 'TestController@leerS3');
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
    //Route::post('/file', 'UploadsController@storeFile')->name('uploads.store-file');
    Route::post('/file', 'UploadsController@subirArchivo')->name('uploads.store-file');
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


        Route::get('custom-mails/edit/{id}', 'Admin\CustomMailsController@index')->name('custom-mails.edit-lang');            
        Route::post('custom-mails/change-enabled', 'Admin\CustomMailsController@changeEnabled')->name('custom-mails.change-enabled');
        Route::post('custom-mails/filter', 'Admin\CustomMailsController@filter')->name('custom-mails.filter');
        Route::get('custom-mails/export-html/{id}', 'Admin\CustomMailsController@exportHtml')->name('custom-mails.export-html');
        Route::get('custom-mails/exportar/{type}', 'Admin\CustomMailsController@export')->name('custom-mails.export');
        Route::resource('custom-mails', 'Admin\CustomMailsController');

        Route::get('contenido-predefinidos/edit/{id}', 'Admin\ContenidoPredefinidoController@index')->name('contenido-predefinidos.edit-lang');            
        Route::post('contenido-predefinidos/change-enabled', 'Admin\ContenidoPredefinidoController@changeEnabled')->name('contenido-predefinidos.change-enabled');
        Route::post('contenido-predefinidos/filter', 'Admin\ContenidoPredefinidoController@filter')->name('contenido-predefinidos.filter');
        Route::resource('contenido-predefinidos', 'Admin\ContenidoPredefinidoController');


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






