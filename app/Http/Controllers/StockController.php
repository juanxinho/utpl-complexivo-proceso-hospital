<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the stock items.
     *
     * This function retrieves and displays a paginated list of stock items.
     *
     * @return \Illuminate\View\View The view displaying the list of stock items.
     */
    public function index()
    {
        // Retrieve paginated stock items
        $stocks = Stock::paginate(10);

        // Return the view with the stocks data
        return view('admin.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new stock item.
     *
     * This function returns the view for creating a new stock item.
     *
     * @return \Illuminate\View\View The view for creating a new stock item.
     */
    public function create()
    {
        return view('admin.stocks.create');
    }

    /**
     * Store a newly created stock item in storage.
     *
     * This function validates and stores a new stock item in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing stock item data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of stock items with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Create the stock item
        Stock::create($request->all());

        // Redirect to the stocks index with a success message
        return redirect()->route('admin.stocks.index')->with('success', 'Stock item created successfully.');
    }

    /**
     * Display the specified stock item.
     *
     * This function retrieves and displays a specific stock item.
     *
     * @param \App\Models\Stock $stock The stock model instance.
     * @return \Illuminate\View\View The view displaying the stock item details.
     */
    public function show(Stock $stock)
    {
        return view('admin.stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified stock item.
     *
     * This function returns the view for editing a specific stock item.
     *
     * @param \App\Models\Stock $stock The stock model instance.
     * @return \Illuminate\View\View The view for editing the stock item.
     */
    public function edit(Stock $stock)
    {
        return view('admin.stocks.edit', compact('stock'));
    }

    /**
     * Update the specified stock item in storage.
     *
     * This function validates and updates an existing stock item in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing updated stock item data.
     * @param \App\Models\Stock $stock The stock model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of stock items with a success message.
     */
    public function update(Request $request, Stock $stock)
    {
        // Validate the request data
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Update the stock item
        $stock->update($request->all());

        // Redirect to the stocks index with a success message
        return redirect()->route('admin.stocks.index')->with('success', 'Stock item updated successfully.');
    }

    /**
     * Remove the specified stock item from storage.
     *
     * This function deletes a specific stock item from the database.
     *
     * @param \App\Models\Stock $stock The stock model instance.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the list of stock items with a success message.
     */
    public function destroy(Stock $stock)
    {
        // Delete the stock item
        $stock->delete();

        // Redirect to the stocks index with a success message
        return redirect()->route('admin.stocks.index')->with('success', 'Stock item deleted successfully.');
    }
}
