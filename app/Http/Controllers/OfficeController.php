<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BfarOffice;

class OfficeController extends Controller
{
    /**
     * Show the form for creating a new office.
     *
     * @return \Illuminate\View\View
     */
    public function createForm()
    {
        return view('bfar_office');
    }

    /**
     * Store a newly created office in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'office' => 'required|string|max:255',
            'rcc' => 'required|string|max:255',
        ]);

        BfarOffice::create($request->all());

        return redirect()->route('setting.index')->with('success-office', 'Data inserted successfully!');
    }
}
