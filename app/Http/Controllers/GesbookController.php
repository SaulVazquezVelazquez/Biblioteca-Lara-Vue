<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GesbookController extends Controller
{
    public function index()
    {
        return view('admin.libro.index');
    }

}
