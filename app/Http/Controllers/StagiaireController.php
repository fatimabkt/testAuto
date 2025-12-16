<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    public function store(Request $request)
    {
       Stagiaire::create($request->all());
        return redirect()->route('stagiaire.index');
    }
}
