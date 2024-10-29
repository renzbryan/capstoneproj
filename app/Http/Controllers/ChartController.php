<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iar;
use App\Models\Item;

class ChartController extends Controller
{
    // Display the Dashboard View
    public function index()
    {
        return view('manager.dashboard');
    }

    // Get the Count of IAR Records
    public function getIar()
    {
        $iarCount = Iar::count();
        return response()->json(['count' => $iarCount]);
    }

    // Get Inventory Data (Item Name and Quantity)
    public function getInventoryData()
    {
        $inventoryData = Item::select('item_name', 'item_quantity')->get();
        return response()->json($inventoryData);
    }

    // Get Inventory Dates
    public function getInventoryDates()
    {
        $inventoryDates = Item::select('created_at')->get();
        return response()->json($inventoryDates);
    }
}
