<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyItem;
use App\Models\Iar;

class PropertyController extends Controller
{
    /**
     * Display a listing of property entries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all stock entries
        $propertyEntries = PropertyItem::all();

        // Pass the data to the view and return the view
        return view('admin.property.view-property', compact('propertyEntries'));
    }

        public function iar()
    {
        return $this->belongsTo(IAR::class, 'iar_id'); // Adjust the foreign key if needed
    }

    public function edit($id)
    {
        // Fetch the Pcitem based on its ID
        $pcitem = Pcitem::findOrFail($id);

        // Pass pcitem data to the view
        return view('admin.pcitems.create-pcitems', compact('pcitem'));
    }

    

}
