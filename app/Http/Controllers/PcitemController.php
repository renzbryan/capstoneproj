<?php

namespace App\Http\Controllers;

use App\Models\Pcitem; // Update model to Pcitem
use App\Models\PropertyItem;
use App\Models\IAR;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PcitemController extends Controller
{
    // Display a listing of pcitems
    public function index($id)
    {
        // Fetch pcitem entries that match the specified ID
        $pcEntries = DB::table('pcitems')
            ->leftJoin('iar_tbl', 'pcitems.iar_id', '=', 'iar_tbl.iar_id') // Join with iar_tbl
            ->leftJoin('propertys', 'pcitems.property_id', '=', 'propertys.id') // Join with property
            ->select(
                'pcitems.*', // Select all columns from pcitems
                'iar_tbl.iar_entityname',
                'iar_tbl.iar_fundcluster',
                'propertys.property_name', // Assuming propertys has a property_name column
                'propertys.property_desc'   // Assuming propertys has a property_desc column
            )
            ->where('pcitems.id', $id) // Add this line to filter by id
            ->get();

        // Pass the retrieved data to the view
        return view('admin.pcitems.view-pcitems', compact('pcEntries'));
    }
    public function create($id)
{
    // Fetch the PropertyItem based on its ID
    $propertyItem = PropertyItem::findOrFail($id);

    // Pass the propertyItem data to the view
    return view('admin.pcitems.create-pcitems', compact('propertyItem'));
}
    public function store(Request $request)
    {
        // Fetch the PropertyItem based on the hidden iar_id from the form
        $propertyItem = PropertyItem::findOrFail($request->propertyItem_id);

        // Validate the incoming request
        $validatedData = $request->validate([
            'property_id' => 'nullable',
            'date' => 'nullable',
            'reference' => 'nullable',
            'receipt_qty' => 'nullable',
            'issue_qty' => 'nullable',
            'issue_office' => 'nullable',
            'balance_qty' => 'nullable',
            'amount' => 'nullable',
            'remarks' => 'nullable',
        ]);

        // Create a new Pcitem record using values from the request and the fetched PropertyItem's iar_id
        Pcitem::create([
            'property_id' => $propertyItem->id,
            'iar_id' => $propertyItem->iar_id, // Use iar_id from PropertyItem
        'date' => $request->date,
        'reference' => $request->reference,
        'receipt_qty' => $request->receipt_qty,
        'issue_qty' => $request->issue_qty,
        'issue_office' => $request->issue_office,
        'balance_qty' => $request->balance_qty,
        'amount' => $request->amount,
        'remarks' => $request->remarks,
    ]);

    return redirect()->back()->with('success', 'PC Item created successfully.');
}



    public function edit($id)
    {
        // Fetch the Pcitem based on its ID
        $pcitem = Pcitem::find($id);
    // Debugging line to check propertyItem data

        // Pass pcitem data to the view
        return view('admin.pcitems.create-pcitems', compact('pcitem'));
    }
    
    public function show($id)
    {
        // Fetch the pcitem that matches the specified property_id
        $pcEntry = DB::table('pcitems')
            ->leftJoin('iar_tbl', 'pcitems.iar_id', '=', 'iar_tbl.iar_id') // Join with iar_tbl
            ->leftJoin('propertys', 'pcitems.property_id', '=', 'propertys.id') // Join with property
            ->select(
                'pcitems.*', // Select all columns from pcitems
                'iar_tbl.iar_entityname',
                'iar_tbl.iar_fundcluster',
                'propertys.name as property_name',
                'propertys.quantity',
                'propertys.description',
                'propertys.unit',
            )
            ->where('pcitems.property_id', $id) // Filter by property_id
            ->first(); // Get a single record instead of a collection
    
        // Pass the retrieved data to the view
        return view('admin.pcitems.view-pcitems', compact('pcEntry'));
    }
    

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'property_id' => 'required', // Ensure property_id is required and exists
            'iar_id' => 'nullable',
            'reference' => 'nullable',
            'receipt_qty' => 'nullable',
            'issue_qty' => 'nullable',
            'issue_office' => 'nullable',
            'balance_qty' => 'nullable',
            'amount' => 'nullable',
            'remarks' => 'nullable',
            'date' => 'nullable',
        ]);

        // Fetch the Pcitem record based on ID
        $pcitem = Pcitem::find($id);

        // Update the existing PC item
        $pcitem->fill($request->all());
        $pcitem->save();

        return redirect()->route('pcitems.index')->with('success', 'PC Item updated successfully.');
    }

    // Remove the specified pcitem from the database
    public function destroy($id)
    {
        $pcitem = Pcitem::findOrFail($id);
        $pcitem->delete();

        return redirect()->route('pcitems.index')->with('success', 'PC Item deleted successfully.');
    }
}
