<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Iar;
use App\Models\StockItem;
use App\Models\PropertyItem;
use App\Models\WMRItem;
use App\Models\CategoryModel;

class ItemsController extends Controller
{
    /**
     * Display a listing of items with their associated IARs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $iars = Iar::get();
        $items = Item::leftJoin('iar_tbl', 'items_tbl.iar_id', '=', 'iar_tbl.iar_id')
            ->select('items_tbl.*', 'iar_tbl.*')
            ->where('iar_tbl.iar_id', '=', 'items_tbl.iar_id')
            ->get();
        
        return view('admin.item.view-items', compact('items', 'iars'));
    }
    
    
    

    // para makuha ang id ng iar
    public function show($id){
        $iars = Iar::where('iar_tbl.iar_id', '=', $id)->get();
        $items = Item::leftJoin('iar_tbl', 'items_tbl.iar_id', '=', 'iar_tbl.iar_id')
            ->select('items_tbl.*', 'iar_tbl.*')
            ->where('iar_tbl.iar_id', '=', $id)
            ->get();
        
        return view('admin.item.view-items', compact('items', 'iars'));
    }

    /**
     * Show the form for creating a new item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::all();
        return view('admin.item.create-items', compact('items'));
    }

    /**
     * Store a newly created item in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $iar_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $iar_id)
    {
        $request->validate([
            'item_name' => 'required',
            'item_desc' => 'required',
            'item_unit' => 'required',
            'item_quantity' => 'required',
            'category' => 'required',
        ]);

        $item = new Item();
        $item->item_name = $request->item_name;
        $item->item_desc = $request->item_desc;
        $item->item_unit = $request->item_unit;
        $item->item_quantity = $request->item_quantity;
        $item->iar_id = $iar_id;

        $item->save();

        return redirect('iar')->with('success', 'SUCCESSFULLY ADDED');
    }

    /**
     * Show the form for adding an item with categories.
     *
     * @param  int  $iar_id
     * @return \Illuminate\View\View
     */
    public function addItemForm($iar_id)
    {
        $categories = CategoryModel::all(); // Fetch all categories from the database
        $iar = Iar::find($iar_id);
        return view('admin.item.create-items', ['iar' => $iar, 'iar_id' => $iar_id, 'categories' => $categories]);
    }

    /**
     * Display a list of archived items for a specific IAR.
     *
     * @param  int  $iar_id
     * @return \Illuminate\View\View
     */
    public function showArchived($iar_id)
    {
        $iars = Iar::where('iar_tbl.iar_id', '=', $iar_id)->onlyTrashed()->get();
        $trashedItems = Item::leftJoin('iar_tbl', 'items_tbl.iar_id', '=', 'iar_tbl.iar_id')
            ->select('items_tbl.*', 'iar_tbl.*')
            ->where('iar_tbl.iar_id', '=', $iar_id)
            ->onlyTrashed()
            ->get();

        return view('admin.item.archived-item', compact('trashedItems', 'iars'));
    }

public function updateItemsStock(Request $request) 
    { 
        $itemIds = $request->input('item_ids', []); 
 
        if (!empty($itemIds)) { 
            // Assuming your model is named 'Item' and the table is 'items_tbl' 
            // Update 'is_stock' column to 1 for selected items 
            Item::whereIn('item_id', $itemIds)->update(['is_stock' => 1]); 
 
            return response()->json(['success' => true]); 
        } else { 
            return response()->json(['success' => false, 'message' => 'No items selected.']); 
        } 
    }

    public function updateItemsProperty(Request $request) 
    { 
        $itemIds = $request->input('item_ids', []); 
 
        if (!empty($itemIds)) { 
            // Update 'is_property' column to 1 for selected items 
            Item::whereIn('item_id', $itemIds)->update(['is_property' => 1]); 
 
            return response()->json(['success' => true]); 
        } else { 
            return response()->json(['success' => false, 'message' => 'No items selected.']); 
        } 
    }

    public function updateItemsWMR(Request $request) 
    { 
        $itemIds = $request->input('item_ids', []); 
 
        if (!empty($itemIds)) { 
            // Update 'is_wmr' column to 1 for selected items 
            Item::whereIn('item_id', $itemIds)->update(['is_wmr' => 1]); 
 
            return response()->json(['success' => true]); 
        } else { 
            return response()->json(['success' => false, 'message' => 'No items selected.']); 
        } 
    }


    public function insertcateg(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
        ]);

        CategoryModel::create([
            'name' => $request->input('category'),
        ]);

        return redirect()->route('setting.index')->with('success-category', 'Category inserted successfully!');
    }

    public function updateItemsStock(Request $request)
    {
        $transferData = $request->input('transfer_data', []);

        foreach ($transferData as $data) {
            $item = Item::find($data['item_id']);

            if ($item) {
                // Subtract the quantity from items_tbl
                $item->item_quantity -= $data['quantity'];
                $item->save();

                // Insert the new record into stock_tbl
                StockItem::create([
                    'item_id' => $data['item_id'],
                    'quantity' => $data['quantity'],
                    'iar_id' => $item->iar_id,
                    'name' => $item->item_name,
                    'description' => $item->item_desc,
                    'unit' => $item->item_unit,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update the property status of selected items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateItemsProperty(Request $request)
    {
        $transferData = $request->input('transfer_data', []);

        foreach ($transferData as $data) {
            $item = Item::find($data['item_id']);

            if ($item) {
                // Subtract the quantity from items_tbl
                $item->item_quantity -= $data['quantity'];
                $item->save();

                // Insert the new record into property_tbl (assuming you have such a model)
                PropertyItem::create([
                    'item_id' => $data['item_id'],
                    'quantity' => $data['quantity'],
                    'name' => $item->item_name,
                    'iar_id' => $item->iar_id,
                    'description' => $item->item_desc,
                    'unit' => $item->item_unit,
                ]);
            }
        }
            
        return response()->json(['success' => true]);
    }

    /**
     * Update the WMR status of selected items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateItemsWMR(Request $request)
    {
        $transferData = $request->input('transfer_data', []);

        foreach ($transferData as $data) {
            $item = Item::find($data['item_id']);

            if ($item) {
                // Subtract the quantity from items_tbl
                $item->item_quantity -= $data['quantity'];
                $item->save();

                // Insert the new record into wmr_tbl (assuming you have such a model)
                WMRItem::create([
                    'item_id' => $data['item_id'],
                    'quantity' => $data['quantity'],
                    'name' => $item->item_name,
                    'description' => $item->item_desc,
                    'unit' => $item->item_unit,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }
}
