<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Fetch all stock entries
        $stockEntries = StockItem::all();

        // Calculate the total number of items
        $totalItems = $stockEntries->count();

        // Calculate the number of items in stock (quantity > 0)
        $inStockItems = $stockEntries->where('quantity', '>', 0)->count();

        // Calculate the number of items out of stock (quantity = 0)
        $outOfStockItems = $stockEntries->where('quantity', '=', 0)->count();

        // Pass the data to the view
        return view('admin.stock.view-stock', compact('stockEntries', 'totalItems', 'inStockItems', 'outOfStockItems'));
    }

    public function create()
    {
        return view('admin.sample.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function edit(Student $student)
    {
        return view('admin.sample.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student archived successfully.');
    }

    public function archived()
    {
        $students = Student::onlyTrashed()->get();
        return view('sample.archived', compact('students'));
    }
       

    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.index')->with('success', 'Student restored successfully.');
    }

    public function show(Student $student)
{
    return view('sample.show', compact('student'));
}

public function dashboard()
{
    // Count total items
    $totalItems = StockItem::count();

    // Count in-stock items (quantity > 0)
    $inStockItems = StockItem::where('quantity', '>', 0)->count();

    // Count out-of-stock items (quantity = 0)
    $outOfStockItems = StockItem::where('quantity', '=', 0)->count();

    // Pass these values to the view
    return view('dashboard', compact('totalItems', 'inStockItems', 'outOfStockItems'));
}


}

