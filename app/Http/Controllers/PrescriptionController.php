<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the prescriptions for the authenticated patient.
     *
     * This function retrieves and displays a list of prescriptions for the currently authenticated patient,
     * ordered by date in descending order.
     *
     * @return \Illuminate\View\View The view displaying the list of prescriptions.
     */
    public function index()
    {
        // Retrieve prescriptions for the authenticated patient, ordered by date in descending order
        $prescriptions = Prescription::where('patient_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        // Return the view with the prescriptions data
        return view('front.prescriptions.index', compact('prescriptions'));
    }
}
