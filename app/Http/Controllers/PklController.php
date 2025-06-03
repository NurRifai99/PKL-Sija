<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PklController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display PKL data
        return view('pkl');
    }
}
