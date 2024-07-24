<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the results for the authenticated patient.
     *
     * This function retrieves and displays a list of results for the currently authenticated patient.
     *
     * @return \Illuminate\View\View The view displaying the list of results.
     */
    public function index()
    {
        // Fetch results for the authenticated patient
        $results = Auth::user()->results()->get();

        // Return the view with the results data
        return view('front.results.index', compact('results'));
    }
}

