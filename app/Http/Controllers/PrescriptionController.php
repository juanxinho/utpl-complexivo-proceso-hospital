<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{

    public function index()
    {
        $prescriptions = Prescription::where('patient_id', Auth::id())
                                    ->orderBy('date', 'desc')
                                    ->get();
        return view('front.prescriptions.index', compact('prescriptions'));
    }
}
