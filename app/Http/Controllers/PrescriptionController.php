<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\StockItem;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function create()
    {
        $stockItems = StockItem::all();
        return view('prescriptions.create', compact('stockItems'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.stock_item_id' => 'required|exists:stocks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $prescription = Prescription::create([
            'patient_id' => $validatedData['patient_id'],
            'doctor_id' => $validatedData['doctor_id'],
            'notes' => $request->notes,
        ]);

        foreach ($validatedData['items'] as $item) {
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'stock_item_id' => $item['stock_item_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
    }

    public function index()
    {
        $prescriptions = Prescription::with('items.stockItem')->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }
}
