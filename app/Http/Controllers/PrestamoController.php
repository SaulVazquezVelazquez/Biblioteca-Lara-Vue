<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function __construct()
    {
        #De esta forma protegemos las rutas dependiendo el tipo de rol que este tenga asignado
        // $this->middleware('can:admin.prestamo.create')->only('index');
        // $this->middleware('can:admin.prestamo.create')->only('edit','update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $idsesion = Auth::user()->id;
        
        $prestamos = DB::select('SELECT us.name , pre.id , li.nombreLi , li.autorLi , li.statusLi , pre.fechap , pre.fechad , pre.statusprestamo , pre.libro_id , pre.user_id
                            FROM users us , libros li , prestamos pre 
                            WHERE pre.libro_id = li.id 
                            AND us.id = ?', [$idsesion]);
        return  $prestamos;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insertPrestamo = new Prestamo;
        $insertPrestamo->create($request->all());
        
        $libro_id = $request->libro_id;
        DB::update('UPDATE libros SET statusLi = "Ocupado" WHERE id = ?',[$libro_id]);    
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {
        return $prestamo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $libro_id = $request->libro_id;
        echo $libro_id;
        DB::update('UPDATE libros SET statusLi = "Disponible" WHERE id = ?',[$libro_id]);    

        $prestamo->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
    }
}
