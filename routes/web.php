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
        Route::put('custom-mails/{id}/clonar', 'Admin\CustomMailsController@clonar')->name('custom-mails.clonar');
        Route::resource('custom-mails', 'Admin\CustomMailsController');

        Route::get('contenido-predefinidos/edit/{id}', 'Admin\ContenidoPredefinidoController@index')->name('contenido-predefinidos.edit-lang');            
        Route::post('contenido-predefinidos/change-enabled', 'Admin\ContenidoPredefinidoController@changeEnabled')->name('contenido-predefinidos.change-enabled');
        Route::post('contenido-predefinidos/filter', 'Admin\ContenidoPredefinidoController@filter')->name('contenido-predefinidos.filter');
        Route::resource('contenido-predefinidos', 'Admin\ContenidoPredefinidoController');

        /* ** Etapa 2 ** */
        Route::post('slot-mails/grupo/{id}', 'Admin\SlotMailsController@storeGrupo')->name('slot-mails.store-grupo'); 
        Route::post('slot-mails/grupo/{id}/delete', 'Admin\SlotMailsController@deleteGrupo')->name('slot-mails.delete-grupo');  
        Route::put('slot-mail/grupo/{id}/clonar', 'Admin\SlotMailsController@clonarGrupo')->name('slot-mail.clonar-grupo');          
        Route::put('slot-mails/grupo/{id}/cambiar-valor', 'Admin\SlotMailsController@cambiarValorGrupo')->name('slot-mails.cambiar-valor-grupo');            
        Route::get('slot-mails/edit/{id}', 'Admin\SlotMailsController@index')->name('slot-mails.edit-lang');            
        Route::post('slot-mails/change-enabled', 'Admin\SlotMailsController@changeEnabled')->name('slot-mails.change-enabled');
        Route::post('slot-mails/filter', 'Admin\SlotMailsController@filter')->name('slot-mails.filter');
        Route::get('slot-mails/export-html/{id}/{hijo}', 'Admin\SlotMailsController@exportHtml')->name('slot-mails.export-html');
        Route::get('slot-mails/exportar/{type}', 'Admin\SlotMailsController@export')->name('slot-mails.export');
        Route::put('slot-mails/{id}/clonar', 'Admin\SlotMailsController@clonar')->name('slot-mails.clonar');
        Route::resource('slot-mails', 'Admin\SlotMailsController');

        Route::get('slot-mail-contents/edit/{id}', 'Admin\SlotMailContentsController@index')->name('slot-mail-contents.edit-lang');            
        Route::post('slot-mail-contents/change-enabled', 'Admin\SlotMailContentsController@changeEnabled')->name('slot-mail-contents.change-enabled');
        Route::post('slot-mail-contents/filter', 'Admin\SlotMailContentsController@filter')->name('slot-mail-contents.filter');
        Route::get('slot-mail-contents/export-html/{id}', 'Admin\SlotMailContentsController@exportHtml')->name('slot-mail-contents.export-html');
        Route::get('slot-mail-contents/exportar/{type}', 'Admin\SlotMailContentsController@export')->name('slot-mail-contents.export');
        Route::put('slot-mail-contents/{id}/clonar', 'Admin\SlotMailContentsController@clonar')->name('slot-mail-contents.clonar');
        Route::resource('slot-mail-contents', 'Admin\SlotMailContentsController');

        Route::get('slot-contenido-predefinidos/edit/{id}', 'Admin\SlotContenidoPredefinidoController@index')->name('slot-contenido-predefinidos.edit-lang');            
        Route::post('slot-contenido-predefinidos/change-enabled', 'Admin\SlotContenidoPredefinidoController@changeEnabled')->name('slot-contenido-predefinidos.change-enabled');
        Route::post('slot-contenido-predefinidos/filter', 'Admin\SlotContenidoPredefinidoController@filter')->name('slot-contenido-predefinidos.filter');
        Route::resource('slot-contenido-predefinidos', 'Admin\SlotContenidoPredefinidoController');
        /* ** END Etapa 2 ** */


        Route::get('configuraciones/s3','Admin\ConfigS3Controller@index')->name('configuraciones.s3');            
        Route::post('configuraciones/s3','Admin\ConfigS3Controller@guardar')->name('configuraciones.s3.guardar');            


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

Route::get('/',function() {
    return redirect()->route('admin.home');
});