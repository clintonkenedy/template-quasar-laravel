<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermisoRequest;
use Faker\Core\Number;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return $this->generateViewSetList(
            $request,
            Permission::query(),
            [],
            ['id', 'name'],
            ['id', 'name', 'description']
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermisoRequest $request)
    {
        //
        return response(Permission::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permiso)
    {
        //
        return response()->json($permiso);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePermisoRequest $request, Permission $permiso)
    {
        //
        $permiso->update($request->all());
        // Permission::find($id)->update($request->all());
        return response()->json([$request, $permiso]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permiso)
    {
        //
        return response()->json($permiso->delete());
    }
}
