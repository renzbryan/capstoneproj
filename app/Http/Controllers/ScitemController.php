<?php

namespace App\Http\Controllers;

use App\Models\Scitem;

use App\Models\StockItem;
use App\Models\IAR;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ScitemController extends Controller
{
    // Display a listing of scitems
    public function index($id)
    {
        // Fetch stock entries that match the specified ID
        $stockEntries = DB::table('scitems')
            ->leftJoin('iar_tbl', 'scitems.iar_id', '=', 'iar_tbl.iar_id') // Join with iar_tbl
            ->leftJoin('items_tbl', 'scitems.iar_id', '=', 'items_tbl.iar_id') // Join with items
            ->select(
                'scitems.*', // Select all columns from scitems
                'iar_tbl.iar_entityname',
                'iar_tbl.iar_fundcluster',
                'items_tbl.item_name',
                'items_tbl.item_desc',
                'items_tbl.item_unit'
            )
            ->where('scitems.id', $id) // Add this line to filter by id
            ->get();
    
        // Pass the retrieved data to the view
        return view('admin.scitems.view-scitems', compact('stockEntries'));
    }
    
    public function create($id)
    {
        // Fetch the StockItem based on its ID
        $stockItem = StockItem::findOrFail($id);
    
        // Pass stockItem data to the view
        return view('admin.scitems.create-scitems', compact('stockItem'));
    }
    
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'reorder_point' => 'nullable',
            'reference' => 'nullable',
            'receipt_qty' => 'nullable',
            'issue_qty' => 'nullable',
            'issue_office' => 'nullable',
            'balance_qty' => 'nullable',
            'consume' => 'nullable',
            'date' => 'nullable',
        ]);
    
        // Fetch the StockItem based on stocks_id
        $stockItem = StockItem::findOrFail($request->id);
    
        // Create a new Scitem record associated with the StockItem
        Scitem::create([
            'stocks_id' => $stockItem->id, // Associate with StockItem's ID
            'iar_id' => $stockItem->iar_id, // Store the iar_id from StockItem
            'date' => $request->date,
            'reorder_point' => $request->reorder_point,
            'reference' => $request->reference,
            'receipt_qty' => $request->receipt_qty,
            'issue_qty' => $request->issue_qty,
            'issue_office' => $request->issue_office,
            'balance_qty' => $request->balance_qty,
            'consume' => $request->consume,
        ]);
    // Redirect back to the previous page after storing data
return redirect()->back()->with('success', 'SC Item created successfully.');
    }   
    

public function edit($id)
{
       // Fetch the StockItem based on its ID
       $stockItem = StockItem::findOrFail($id);
    
       // Pass stockItem data to the view
       return view('admin.scitems.create-scitems', compact('stockItem'));
}

    
    public function show($id)
    {
        // Fetch the stock entry that matches the specified stocks_id
        $stockEntry = DB::table('scitems')
            ->leftJoin('iar_tbl', 'scitems.iar_id', '=', 'iar_tbl.iar_id') // Join with iar_tbl
            ->leftJoin('stocks', 'scitems.stocks_id', '=', 'stocks.id') // Join with stocks
            ->select(
                'scitems.*', // Select all columns from scitems
                'iar_tbl.iar_entityname',
                'iar_tbl.iar_fundcluster',
                'stocks.name as stock_name',
                'stocks.quantity',
                'stocks.description',
                'stocks.unit'
            )
            ->where('scitems.stocks_id', $id) // Filter by the passed stocks_id
            ->first(); // Get a single record instead of a collection
    
        // Pass the retrieved data to the view
        return view('admin.scitems.view-scitems', compact('stockEntry'));
    }
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'stocks_id' => 'required|exists:stocks,id', // Ensure stocks_id is required and exists
            'reorder_point' => 'nullable',
            'reference' => 'nullable',
            'receipt_qty' => 'nullable',
            'issue_qty' => 'nullable',
            'issue_office' => 'nullable',
            'balance_qty' => 'nullable',
            'consume' => 'nullable',
            'date' => 'nullable',
        ]);
    
        // Fetch the StockItem based on stocks_id
        $stockItem = StockItem::findOrFail($request->stocks_id);
    
        // Check if a Scitem record exists for the given stocks_id
        $scitem = Scitem::where('stocks_id', $stockItem->id)->first();
    
        if ($scitem) {
            // Update the existing SC item
            $scitem->fill($request->all());
            $scitem->iar_id = $stockItem->iar_id; // Ensure iar_id is set correctly
            $scitem->save();
    
            return redirect()->route('scitems.index')->with('success', 'SC Item updated successfully.');
        } else {
            // Create a new Scitem record
            Scitem::create(array_merge($request->all(), [
                'iar_id' => $stockItem->iar_id, // Store the iar_id from StockItem
            ]));
    
            return redirect()->route('scitems.index')->with('success', 'SC Item created successfully.');
        }
    }
    
    
    

    // Remove the specified scitem from the database
    public function destroy($id)
    {
        $scitem = Scitem::findOrFail($id);
        $scitem->delete();

        return redirect()->route('scitems.index')->with('success', 'SC Item deleted successfully.');
    }
}
