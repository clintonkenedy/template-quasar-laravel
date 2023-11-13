<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRolesRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->generateViewSetList(
            $request,
            Role::query(),
            [],
            ['id', 'name'],
            ['id', 'name', '']
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest $request)
    {
        //
        $rol = Role::create($request->all());
        if (!empty($request->permisosSelected)) {
            $rol->syncPermissions($request->permisosSelected);
        };

        return response()->json([$rol->save()], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        return response()->json([
            'rol' => $role,
            'permisosSelected' => $role->permissions->pluck('id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRolesRequest $request,  Role $role)
    {
        //
        $role->syncPermissions($request->permisosSelected);
        return response()->json($role->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        return response()->json($role->delete());
    }
}
