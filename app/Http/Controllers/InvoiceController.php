<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\StockItem;
use App\Models\Prescription;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Create an invoice from a prescription.
     *
     * This function generates an invoice based on the provided prescription. It creates a new invoice
     * with the patient ID and notes from the prescription, and then adds each prescribed item to the invoice.
     *
     * @param \App\Models\Prescription $prescription The prescription model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the newly created invoice's detail view.
     */
    public function createFromPrescription(Prescription $prescription)
    {
        // Create a new invoice with patient ID and notes from the prescription
        $invoice = Invoice::create([
            'patient_id' => $prescription->patient_id,
            'notes' => $prescription->notes,
        ]);

        // Add each prescribed item to the invoice
        foreach ($prescription->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'stock_item_id' => $item->stock_item_id,
                'quantity' => $item->quantity,
                'price' => $item->stockItem->price,
            ]);
        }

        // Redirect to the newly created invoice's detail view
        return redirect()->route('admin.invoices.show', $invoice);
    }

    /**
     * Add items to an existing invoice.
     *
     * This function validates and adds items to the specified invoice. Each item includes a stock item ID,
     * quantity, and price.
     *
     * @param \App\Models\Invoice $invoice The invoice model instance.
     * @param \Illuminate\Http\Request $request The HTTP request object containing the items data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the invoice's detail view with a success message.
     */
    public function addItems(Invoice $invoice, Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'items' => 'required|array',
            'items.*.stock_item_id' => 'required|exists:stocks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Add each validated item to the invoice
        foreach ($validatedData['items'] as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'stock_item_id' => $item['stock_item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Redirect to the invoice's detail view with a success message
        return redirect()->route('invoices.show', $invoice)->with('success', 'Items added successfully.');
    }

    /**
     * Display the specified invoice.
     *
     * This function retrieves and displays the details of a specific invoice.
     *
     * @param \App\Models\Invoice $invoice The invoice model instance.
     * @return \Illuminate\View\View The view displaying the invoice details.
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Display a listing of the invoices.
     *
     * This function retrieves and displays a paginated list of all invoices, including related patient and stock item details.
     *
     * @return \Illuminate\View\View The view displaying the list of invoices.
     */
    public function index()
    {
        // Retrieve paginated invoices with related patient and stock item details
        $invoices = Invoice::with(['patient', 'items.stockItem'])->paginate(10);

        // Return the view with the invoices data
        return view('admin.invoices.index', compact('invoices'));
    }
}
