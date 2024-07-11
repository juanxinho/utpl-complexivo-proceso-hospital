<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\StockItem;
use App\Models\Prescription;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function createFromPrescription(Prescription $prescription)
    {
        $invoice = Invoice::create([
            'patient_id' => $prescription->patient_id,
            'notes' => $prescription->notes,
        ]);

        foreach ($prescription->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'stock_item_id' => $item->stock_item_id,
                'quantity' => $item->quantity,
                'price' => $item->stockItem->price,
            ]);
        }

        return redirect()->route('admin.invoices.show', $invoice);
    }

    public function addItems(Invoice $invoice, Request $request)
    {
        $validatedData = $request->validate([
            'items' => 'required|array',
            'items.*.stock_item_id' => 'required|exists:stocks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($validatedData['items'] as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'stock_item_id' => $item['stock_item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('invoices.show', $invoice)->with('success', 'Items added successfully.');
    }

    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function index()
    {
        $invoices = Invoice::with(['patient', 'items.stockItem'])->paginate(10);

        return view('admin.invoices.index', compact('invoices'));
    }
}
