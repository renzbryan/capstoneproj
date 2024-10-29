<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\Iar;

class StockController extends Controller
{
    /**
     * Display a listing of items with stock information.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all stock entries with their related IAR
        $stockEntries = StockItem::with('iar')->get();
    
        // Pass the data to the view and return the view
        return view('admin.stock.view-stock', compact('stockEntries'));
    }
    
}
