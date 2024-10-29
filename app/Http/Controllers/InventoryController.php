<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\BfarOffice;

class InventoryController extends Controller
{
    /**
     * Display a listing of inventory items with associated IARs and office options.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $officeModel = new BfarOffice();
        $officeOptions = $officeModel->getOptions();
        $itemsWithIar = Item::with('iar')->get();
        return view('admin.inventory.view-inventory', compact('itemsWithIar', 'officeOptions'));
    }

    /**
     * Store a newly created inventory item in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventory_name' => 'required', 
            'inventory_category' => 'required', 
            'inventory_quantity' => 'required', 
            'inventory_status' => 'required', 
        ]);

        Inventory::create($request->all());
        return redirect('view-inventory')->with('success', 'SUCCESSFULLY ADDED');
    }

    /**
     * Show the form for editing a specific inventory item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('admin.inventory.edit-inventory', compact('inventory'));
    }

    /**
     * Update the specified inventory item in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'inventory_name' => 'required', 
            'inventory_category' => 'required', 
            'inventory_quantity' => 'required', 
            'inventory_status' => 'required', 
        ]);

        $inventory = Inventory::find($id);
        $inventory->update($request->all());
        return redirect('/view-inventory')->with('success', 'SUCCESSFULLY UPDATED');
    }

    /**
     * Display a listing of archived inventory items.
     *
     * @return \Illuminate\View\View
     */
    public function archive()
    {
        $inventories = Inventory::onlyTrashed()->get();
        return view('admin.inventory.archive-inventory', compact('inventories'));
    }

    /**
     * Delete a specific inventory item permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Inventory::find($id)->delete();
        return redirect()->back()->with('success', 'SUCCESSFULLY DELETED');
    }

    /**
     * Restore a specific archived inventory item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        Inventory::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'SUCCESSFULLY RESTORED');
    }
}
