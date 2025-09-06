<?php

namespace App\Http\Controllers;

use App\Models\Voyage;

class VoyageController extends Controller
{
   public function index()
{
    $voyages = \App\Models\Voyage::all();
    return view('voyages.index', compact('voyages'));
}
    public function show($id)
{
    $voyage = Voyage::findOrFail($id);
    return view('voyages.show', compact('voyage'));
}

}

