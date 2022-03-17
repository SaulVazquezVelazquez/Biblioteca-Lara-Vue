<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GesprestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prestamo.index');
    }

}
