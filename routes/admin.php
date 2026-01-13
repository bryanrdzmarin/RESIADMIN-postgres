<?php

use App\Http\Controllers\Admin\AptosController;
use App\Http\Controllers\Admin\BecadosController;
use App\Http\Controllers\admin\BusquedaController;
use App\Http\Controllers\Admin\ResidenciasController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


//Rutas para residencias
Route::get('/residencias', [ResidenciasController::class, 'index'])
    ->middleware('can:admin.residencias.index')->name('residencias.index');

Route::get('/residencias/crear', [ResidenciasController::class, 'create'])
    ->middleware('can:admin.residencias.create')->name('residencias.create');

Route::post('/residencias', [ResidenciasController::class, 'store'])
    ->middleware('can:admin.residencias.store')->name('residencias.store');

Route::get('/residencias/mostrar', [ResidenciasController::class, 'show'])
    ->middleware('can:admin.residencias.show')->name('residencias.show');

Route::get('/residencias/{residencia}/aptos-asociados', [ResidenciasController::class, 'AptosAsociados'])
    ->middleware('can:admin.residencias.aptosAsociados')->name('residencias.aptosAsociados');

Route::get('/residencias/{residencia}/editar', [ResidenciasController::class, 'edit'])
    ->middleware('can:admin.residencias.edit')->name('residencias.edit');

Route::put('/residencias/{residencia}', [ResidenciasController::class, 'update'])
    ->middleware('can:admin.residencias.update')->name('residencias.update');

Route::delete('/residencias/{residencia}', [ResidenciasController::class, 'destroy'])
    ->middleware('can:admin.residencias.destroy')->name('residencias.destroy');

Route::delete('/residencias/{residencia}/aptos-asociados', [ResidenciasController::class, 'destroyMultiplesAptos'])
    ->middleware('can:admin.residencias.destroyMultiplesAptos')->name('residencias.destroyMultiplesAptos');

//Rutas para aptos
Route::get('/aptos', [AptosController::class, 'index'])
    ->middleware('can:admin.aptos.index')->name('aptos.index');

Route::get('/aptos-ocupados', [AptosController::class, 'indexOcupados'])
    ->middleware('can:admin.aptos.indexOcupados')->name('aptos.indexOcupados');

Route::get('/aptos-ocupados/{apto}/becados-asociados/{origen}', [AptosController::class, 'becadosAsociados'])
    ->middleware('can:admin.aptos.becadosAsociados')->name('aptos.becadosAsociados');

Route::get('/aptos-disponibles', [AptosController::class, 'indexDisponibles'])
    ->middleware('can:admin.aptos.indexDisponibles')->name('aptos.indexDisponibles');

Route::get('/aptos-disponibles/{apto}/asignar-becas/{origen}', [AptosController::class, 'reasignarBecados'])
    ->middleware('can:admin.aptos.reasignarBecados')->name('aptos.reasignarBecados');

Route::get('/aptos-disponibles/{apto}/asignar-becas/buscar-becado/{origen}', [AptosController::class, 'showCI'])
    ->middleware('can:admin.aptos.showCI')->name('aptos.showCI');

Route::post('/aptos-disponibles/{apto}/asignar-becas/{origen}', [AptosController::class, 'reubicandoBecado'])
    ->middleware('can:admin.aptos.reubicandoBecado')->name('aptos.reubicandoBecado');

Route::get('/residencias/{residencia}/aptos/crear', [AptosController::class, 'create'])
    ->middleware('can:admin.aptos.create')->name('aptos.create');

Route::post('/residencias/{residencia}/aptos', [AptosController::class, 'store'])
    ->middleware('can:admin.aptos.store')->name('aptos.store');

Route::get('/aptos/mostrar', [AptosController::class, 'show'])
    ->middleware('can:admin.aptos.show')->name('aptos.show');

Route::get('/aptos/mostrar-disponibles', [AptosController::class, 'showDisponibles'])
    ->middleware('can:admin.aptos.showDisponibles')->name('aptos.showDisponibles');

Route::get('/aptos/mostrar-ocupados', [AptosController::class, 'showOcupados'])
    ->middleware('can:admin.aptos.showOcupados')->name('aptos.showOcupados');

Route::get('/aptos/{apto}/editar/{origen}', [AptosController::class, 'edit'])
    ->middleware('can:admin.aptos.edit')->name('aptos.edit');

Route::put('/aptos/{apto}/{origen}', [AptosController::class, 'update'])
    ->middleware('can:admin.aptos.update')->name('aptos.update');

Route::delete('/aptos/{apto}', [AptosController::class, 'destroy'])
    ->middleware('can:admin.aptos.destroy')->name('aptos.destroy');


//Rutas para becados 
Route::get('/becados', [BecadosController::class, 'index'])
    ->middleware('can:admin.becados.index')->name('becados.index');

Route::get('/becados-nacionales', [BecadosController::class, 'indexNacionales'])
    ->middleware('can:admin.becados.indexNacionales')->name('becados.indexNacionales');

Route::get('/becados-extranjeros', [BecadosController::class, 'indexExtranjeros'])
    ->middleware('can:admin.becados.indexExtranjeros')->name('becados.indexExtranjeros');

Route::get('/becados/crear', [BecadosController::class, 'create'])
    ->middleware('can:admin.becados.create')->name('becados.create');

Route::get('/becados/{apto}/crear', [BecadosController::class, 'createApto'])
    ->middleware('can:admin.becados.createApto')->name('becados.createApto');

Route::post('/becados', [BecadosController::class, 'store'])
    ->middleware('can:admin.becados.store')->name('becados.store');

Route::get('/becados/mostrar', [BecadosController::class, 'show'])
    ->middleware('can:admin.becados.show')->name('becados.show');

Route::get('/becados-nacionales/mostrar', [BecadosController::class, 'showNacionales'])
    ->middleware('can:admin.becadosNacionales.show')->name('becadosNacionales.show');

Route::get('/becados-extranjeros/mostrar', [BecadosController::class, 'showExtranjeros'])
    ->middleware('can:admin.becadosExtranjeros.show')->name('becadosExtranjeros.show');

Route::get('/becados/{becado}/editar/{origen}', [BecadosController::class, 'edit'])
    ->middleware('can:admin.becados.edit')->name('becados.edit');

Route::put('/becados/{becados}/{origen}', [BecadosController::class, 'update'])
    ->middleware('can:admin.becados.update')->name('becados.update');

Route::delete('/becados/{becado}', [BecadosController::class, 'destroy'])
    ->middleware('can:admin.becados.destroy')->name('becados.destroy');

Route::delete('/aptos-ocupados/{apto}/becados-asignados/{origen}', [BecadosController::class, 'destroyMultiplesBecados'])
    ->middleware('can:admin.becados.destroyMultiplesBecados')->name('becados.destroyMultiplesBecados');

//Evaluaciones - becados
Route::get('/becados-evaluacion', [BecadosController::class, 'indexbecadosEvaluacion'])
    ->middleware('can:admin.evaluar.becados.indexbecadosEvaluacion')->name('evaluar.becados.indexbecadosEvaluacion');

Route::get('/becados-nacionales-evaluacion', [BecadosController::class, 'indexbecadosNacionalesEvaluacion'])
    ->middleware('can:admin.evaluar.becados.indexbecadosNacionalesEvaluacion')->name('evaluar.becados.indexbecadosNacionalesEvaluacion');

Route::get('/becados-extranjeros-evaluacion', [BecadosController::class, 'indexbecadosExtranjerosEvaluacion'])
    ->middleware('can:admin.evaluar.becados.indexbecadosExtranjerosEvaluacion')->name('evaluar.becados.indexbecadosExtranjerosEvaluacion');

Route::get('/becados-evaluacion/mostrar', [BecadosController::class, 'showbecadosEvaluacion'])
    ->middleware('can:admin.evaluar.becados.showbecadosEvaluacion')->name('evaluar.becados.showbecadosEvaluacion');

Route::get('/becados-nacionales-evaluacion/mostrar', [BecadosController::class, 'showbecadosNacionalesEvaluacion'])
    ->middleware('can:admin.evaluar.becados.showbecadosNacionalesEvaluacion')->name('evaluar.becados.showbecadosNacionalesEvaluacion');

Route::get('/becados-extranjeros-evaluacion/mostrar', [BecadosController::class, 'showbecadosExtranjerosEvaluacion'])
    ->middleware('can:admin.evaluar.becados.showbecadosExtranjerosEvaluacion')->name('evaluar.becados.showbecadosExtranjerosEvaluacion');

Route::get('/becados-evaluacion/{becado}/evaluar/{origen}', [BecadosController::class, 'evaluarBecado'])
    ->middleware('can:admin.evaluar.becados.evaluarBecado')->name('evaluar.becados.evaluarBecado');

Route::post('/becados-evaluacion/{becado}/agregar/{origen}', [BecadosController::class, 'storeEvaluacion'])
    ->middleware('can:admin.evaluar.becados.storeEvaluacion')->name('evaluar.becados.storeEvaluacion');

Route::get('/becados-evaluacion/{becado}/editar/{origen}', [BecadosController::class, 'editarEvaluacion'])
    ->middleware('can:admin.evaluar.becados.editarEvaluacion')->name('evaluar.becados.editarEvaluacion');

Route::put('/becados-evaluacion/{becado}/editar/{origen}', [BecadosController::class, 'updateEvaluacion'])
    ->middleware('can:admin.evaluar.becados.updateEvaluacion')->name('evaluar.becados.updateEvaluacion');

//Evaluaciones - aptos
Route::get('/aptos-evaluacion', [AptosController::class, 'indexEvaluacion'])
    ->middleware('can:admin.evaluar.aptos.indexEvaluacion')->name('evaluar.aptos.indexEvaluacion');

Route::get('/aptos-evaluacion/{apto}/becados-asociados', [AptosController::class, 'becadosAsociadosEvalucion'])
    ->middleware('can:admin.evaluar.aptos.becadosAsociadosEvalucion')->name('evaluar.aptos.becadosAsociadosEvalucion');

Route::get('/aptos-evaluacion/mostrar', [AptosController::class, 'showAptosEvaluacion'])
    ->middleware('can:admin.evaluar.aptos.showAptosEvaluacion')->name('evaluar.aptos.showAptosEvaluacion');

//Busqueda - residencias
Route::get('/busqueda-avanzada-residencias', [BusquedaController::class, 'indexResidencias'])
    ->middleware('can:admin.busqueda.residencias.indexResidencias')->name('busqueda.residencias.indexResidencias');

Route::get('/busqueda-avanzada-residencias/mostrar', [BusquedaController::class, 'indexResidenciasMostrar'])
    ->middleware('can:admin.busqueda.residencias.indexResidenciasMostrar')->name('busqueda.residencias.indexResidenciasMostrar');

//Busqueda - aptos
Route::get('/busqueda-avanzada-aptos', [BusquedaController::class, 'indexAptos'])
    ->middleware('can:admin.busqueda.aptos.indexAptos')->name('busqueda.aptos.indexAptos');

Route::get('/busqueda-avanzada-aptos/mostrar', [BusquedaController::class, 'indexAptosMostrar'])
    ->middleware('can:admin.busqueda.aptos.indexAptosMostrar')->name('busqueda.aptos.indexAptosMostrar');

//Busqueda - becados
Route::get('/busqueda-avanzada-becados', [BusquedaController::class, 'indexBecados'])
    ->middleware('can:admin.busqueda.becados.indexBecados')->name('busqueda.becados.indexBecados');

Route::get('/busqueda-avanzada-becados/mostrar', [BusquedaController::class, 'indexBecadosMostrar'])
    ->middleware('can:admin.busqueda.becados.indexBecadosMostrar')->name('busqueda.becados.indexBecadosMostrar');

//Gestion de usuarios
Route::get('/gestion-usuarios', [UserController::class, 'index'])
    ->middleware('can:admin.usuarios.index')->name('usuarios.index');

Route::get('/gestion-usuarios/crear', [UserController::class, 'create'])
    ->middleware('can:admin.usuarios.create')->name('usuarios.create');

Route::post('/gestion-usuarios', [UserController::class, 'store'])
    ->middleware('can:admin.usuarios.store')->name('usuarios.store');

Route::get('/gestion-usuarios/mostrar', [UserController::class, 'show'])
    ->middleware('can:admin.usuarios.show')->name('usuarios.show');

Route::get('/gestion-usuarios/{user}/editar', [UserController::class, 'edit'])
    ->middleware('can:admin.usuarios.edit')->name('usuarios.edit');

Route::put('/gestion-usuarios/{user}', [UserController::class, 'update'])
    ->middleware('can:admin.usuarios.update')->name('usuarios.update');

Route::delete('/gestion-usuarios/{user}', [UserController::class, 'destroy'])
    ->middleware('can:admin.usuarios.destroy')->name('usuarios.destroy');