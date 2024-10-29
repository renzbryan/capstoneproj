<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\PropertyItem;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        // Count the total stock items that have quantity greater than 0
        $inStockCount = StockItem::where('quantity', '>', 0)->count();
        $outOfStockCount = StockItem::where('quantity', '=', 0)->count(); // Count for out of stock
        $inPropCount = PropertyItem::where('quantity', '>', 0)->count();
    
        // Count items from the Item model
        $inItemCount = Item::where('items_tbl.item_quantity', '>', 0)->count();
        $outItemCount = Item::where('items_tbl.item_quantity', '=', 0)->count(); // Count for out of stock
    
        return view('dashboard', compact('inStockCount', 'outOfStockCount', 'inPropCount', 'inItemCount', 'outItemCount'));
    }
    

public function getStockCounts()
{
    $inStockCount = Item::where('quantity', '>', 0)->count();
    $outOfStockCount = Item::where('quantity', '=', 0)->count();

    return response()->json([
        'inStockCount' => $inStockCount,
        'outOfStockCount' => $outOfStockCount,
    ]);
}

}
