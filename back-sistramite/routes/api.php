<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolioController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UbigeoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    $roles = $request->user()->roles;
    $permisos = [];
    foreach ($roles as $rol) {

        # code...
        $permisos = array_merge($permisos, $rol->permissions->pluck('name')->toArray());

        // $permisos=$rol->permissions->pluck('name');
    }
    $permisos = array_values(array_unique($permisos));

    return response()->json([
        'user' => $request->user(),
        // 'rolesSelected' => $request->user()->roles,
        'permisos' => $permisos,
        'roles' => $request->user()->roles->pluck('name'),
    ]);
});

Route::get('ubigeo', [UbigeoController::class, 'getUbigeo']);
Route::get('departamentos', [UbigeoController::class, 'getDepartamentos']);
Route::get('provincias', [UbigeoController::class, 'getProvincias']);
Route::get('distritos', [UbigeoController::class, 'getDistritos']);

Route::apiResource('/folios', FolioController::class)->middleware([HandlePrecognitiveRequests::class]);
Route::apiResource('/usuarios', UserController::class)->middleware([HandlePrecognitiveRequests::class]);
Route::apiResource('/roles', RoleController::class)->middleware([HandlePrecognitiveRequests::class]);
Route::apiResource('/permisos', PermisoController::class)->middleware([HandlePrecognitiveRequests::class]);

