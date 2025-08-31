<?php

namespace App\Http\Controllers;

use App\Models\Voyage;

class VoyageController extends Controller
{
    public function index()
    {
        $voyages = Voyage::all();
        return view('voyages.index', compact('voyages'));
    }
}

