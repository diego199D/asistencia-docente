<?php

namespace App\Http\Controllers;

use App\Models\DocenteClases;
use App\Models\Horario;
use Illuminate\Http\Request;

class DocenteClasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocenteClases  $docenteClases
     * @return \Illuminate\Http\Response
     */
    public function show(DocenteClases $docenteClases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocenteClases  $docenteClases
     * @return \Illuminate\Http\Response
     */
    public function edit(DocenteClases $docenteClases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocenteClases  $docenteClases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocenteClases $docenteClases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocenteClases  $docenteClases
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocenteClases $docenteClases)
    {
        //
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
