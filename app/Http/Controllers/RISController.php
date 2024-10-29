<?php
namespace App\Http\Controllers;

use App\Models\RIS;
use Illuminate\Http\Request;

class RISController extends Controller
{
    public function index()
    {
        $ris = RIS::all();
        return view('admin.ris.view-ris', compact('ris'));
    }

    public function create()
    {
        return view('admin.ris.create-ris');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entity_name' => 'required',
            'fundcluster' => 'required',
            'division' => 'required',
            'office' => 'required',
            'rcc' => 'required',
        ]);

        RIS::create($validated);

        return redirect()->route('ris.index');
    }
}

