<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        // Fetch results for the authenticated patient
        $results = Auth::user()->results()->get();
        return view('front.results.index', compact('results'));
    }
}
