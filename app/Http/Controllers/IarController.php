<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iar;
use App\Exports\ExportExc;
use App\Models\Item;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Models\BfarOffice;
use Illuminate\Support\Facades\Log;
use App\Models\Task;
use App\Models\Property;
use PhpOffice\PhpSpreadsheet\IOFactory;

class IarController extends Controller
{
    /**
     * Display a listing of IARs with comments and users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $iars = Iar::with(['comments.user'])->get();
        return view('admin.iar.view-iar', compact('iars'));
    }

    public function create()
    {
        $iar= new Iar();
        $iars = Iar::get();
        $model = new BfarOffice();
        $officeOptions = $model->getOptions();
        $lastInsertedId = $iar->iar_id;

        // Generate the IAR number
        $iarNumber = 'IAR-' . str_pad($lastInsertedId, 4, '0', STR_PAD_LEFT);
        return view('admin.iar.create-iar', compact('iars', 'officeOptions','iarNumber'));
    }
    public function getOfficeCode($id)
    {
        $model = new BfarOffice();
        $office = $model->find($id);
    
        if ($office) {
            $officeCode = $office->rcc; 
            return response()->json(['officeCode' => $officeCode]);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    /**
     * Store a newly created IAR in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'iar_entityname' => 'nullable', 
            'iar_fundcluster' => 'nullable', 
            'iar_supplier' => 'nullable', 
            'iar_Podate' => 'nullable', 
            'iar_rod' => 'nullable', 
            'iar_rcc' => 'nullable', 
            'iar_number' => 'nullable', 
            'iar_date' => 'nullable', 
            'iar_invoice' => 'nullable', 
            'iar_invoice_d' => 'nullable', 
        ]);

        $selectedOfficeId = $request->iar_rod;
        $selectedOffice = BfarOffice::findOrFail($selectedOfficeId);
        $iarRodValue = $selectedOffice ? $selectedOffice->office : null;
        $requestData = $request->all();
        $requestData['iar_rod'] = $iarRodValue;

        Iar::create($requestData);

        // Update related task status if task ID is provided
        $taskId = $request->input('task_id'); 
        if ($taskId) {
            $task = Task::findOrFail($taskId);
            $task->status = 'done';
            $task->save();
        }

        return redirect('iar')->with('success', 'SUCCESSFULLY ADDED');
    }
    


    public function downloadExcel($id)
    {
            $rowID = Iar::find($id);
            $export = new ExportExc($rowID->iar_id);
            return $export->export();
    }

    /**
     * Show the form for updating the Excel file.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('exceledit');
    }

    /**
     * Update the Excel file with new data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateExcel(Request $request)
    {
        $selectedFile = $request->input('excel_file');
        $filePaths = [
            'iar' => storage_path('app/IAR.xlsx'),
            'another_excel' => storage_path('app/Another_Excel.xlsx'),
            'yet_another_excel' => storage_path('app/Yet_Another_Excel.xlsx'),
        ];
        if (!array_key_exists($selectedFile, $filePaths)) {
            return redirect()->back()->with('error', 'Invalid file selected.');
        }
    
        $filePath = $filePaths[$selectedFile];
        $spreadsheet = IOFactory::load($filePath);
        $updatedValue = strtoupper($request->input('updated_value'));
        $spreadsheet->getActiveSheet()->setCellValue('G51', $updatedValue);
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filePath);
        return redirect()->route('setting.index')->with('success', 'IAR excel file edited successfully!');
    }
    

    /**
     * Delete a specific IAR and its related items.
     *
     * @param  int  $iar_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteIar($iar_id)
    {
        $iar = Iar::find($iar_id);
        $iar->items()->delete();
        $iar->delete();

        return redirect('iar')->with('success', 'Iar and related items deleted successfully.');
    }

    /**
     * Display a listing of archived IARs.
     *
     * @return \Illuminate\View\View
     */
    public function archiveIar()
    {
        $softDeletedItem = Iar::onlyTrashed()->get();
        return view('admin.iar.archive-iar', compact('softDeletedItem'));
    }

    /**
     * Restore a specific archived IAR and its associated items.
     *
     * @param  int  $iar_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreIar($iar_id)
    {
        Iar::withTrashed()->where('iar_id', $iar_id)->restore();
        Item::where('iar_id', $iar_id)->withTrashed()->restore();

        return redirect('iar')->with('success', 'Iar and associated items restored successfully.');
    }

    /**
     * Test method for rendering a test view.
     *
     * @return \Illuminate\View\View
     */
    public function test()
    {
        return view('test');
    }

    public function propertyItems()
    {
        return $this->hasMany(PropertyItem::class, 'iar_id'); // Adjust the foreign key if needed
    }

}
