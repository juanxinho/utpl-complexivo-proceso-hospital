<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        // Fetch prescriptions for the authenticated patient
        $prescriptions = Auth::user()->prescriptions()->get();
        return view('front.prescriptions.index', compact('prescriptions'));
    }
}

