<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use phpDocumentor\Reflection\Types\Resource_;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Detalle_ventaController;

Route::get('/', function () {
    return view('Home.HomeIndex');
});


Route::resource('clientes', ClienteController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('roles', RolController::class);
Route::resource('planes', PlanController::class)->parameters([
    'planes'=>'plan',
]);
Route::resource('citas', CitaController::class);
Route::resource('asistencias', AsistenciaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('ventas', VentaController::class);
Route::resource('detalles_ventas', Detalle_ventaController::class);
Route::resource('notificaciones', NotificacionController::class);
Route::resource('pagos', PagoController::class);

