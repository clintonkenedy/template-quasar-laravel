<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFolioRequest;
class FolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Folio::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFolioRequest $request)
    {
        //
        // return 'faaa';
        // return $request;
        return response(Folio::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Folio $folio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folio $folio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folio $folio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folio $folio)
    {
        //
    }
}
