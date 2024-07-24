<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the treatments for the authenticated patient.
     *
     * This function retrieves and displays a list of treatments for the currently authenticated patient.
     *
     * @return \Illuminate\View\View The view displaying the list of treatments.
     */
    public function index()
    {
        // Fetch treatments for the authenticated patient
        $treatments = Auth::user()->treatments()->get();

        // Return the view with the treatments data
        return view('front.treatments.index', compact('treatments'));
    }
}
