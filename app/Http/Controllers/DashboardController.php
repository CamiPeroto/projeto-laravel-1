<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //Carregar a view
        return view('dashboard.index', ['menu' => 'dashboard']);
    }
}
