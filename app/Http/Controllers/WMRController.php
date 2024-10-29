<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WMRItem;

class WMRController extends Controller
{
    /**
     * Display a listing of WMR entries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all stock entries
        $wmrEntries = WMRItem::all();
    
        // Pass the data to the view and return the view
        return view('admin.wmr.view-wmr', compact('wmrEntries'));
    }
}
