<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        // Fetch treatments for the authenticated patient
        $treatments = Auth::user()->treatments()->get();
        return view('front.treatments.index', compact('treatments'));
    }
}
