<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Item;

class AdminController extends Controller
{
    // Dashboard View
    public function dashboard()
    {
        return view('admin.task.assigntask');
    }

    // Generate Reports (CSV & PDF)
    public function generate(Request $request)
    {
        // Retrieve Inventory Data
        $items = Item::all();
    
        // Define Column Labels
        $header = [
            'Item Name',
            'Item Description',
            'Item Unit',
            'Item Quantity',
            'Is Stock',
            'Is Property',
            'Is WMR',
        ];
    
        // Process Data to Generate Report
        $reportData = [];
        foreach ($items as $item) {
            $isStock = $item->is_stock == 1 ? 'Yes' : 'No';
            $isProperty = $item->is_property == 1 ? 'Yes' : 'No';
            $isWmr = $item->is_wmr == 1 ? 'Yes' : 'No';
            
            $reportData[] = [
                $item->item_name,
                $item->item_desc,
                $item->item_unit,
                $item->item_quantity,
                $isStock,
                $isProperty,
                $isWmr,
            ];
        }
    
        // Format the CSV Report Data
        $csvFormattedData = implode(',', $header) . PHP_EOL; // Add Header Row
        foreach ($reportData as $row) {
            $csvFormattedData .= implode(',', $row) . PHP_EOL;
        }
    
        // Generate and Save the CSV Report
        $csvFileName = 'inventory_report.csv';
        $csvFilePath = storage_path('app/' . $csvFileName);
        file_put_contents($csvFilePath, $csvFormattedData);
    
        // Generate and Save the PDF Report
        $pdfFileName = 'inventory_report.pdf';
        $pdfFilePath = storage_path('app/' . $pdfFileName);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('manager.dashboard', compact('header', 'reportData')));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        file_put_contents($pdfFilePath, $dompdf->output());
    
        // Return Download Links or Redirect to Download Page
        return response()->json([
            'csv_download_link' => route('download', ['file' => $csvFileName]),
            'pdf_download_link' => route('download', ['file' => $pdfFileName]),
        ]);
    }
}
