<?php

namespace App\Http\Controllers;
use App\Exports\ExportExc; // Your export class that handles the Excel to PDF process
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class PDFcontroller extends Controller
{


    public function exportPdf($rowId)
    {
        try {
            // Create an instance of your ExportExc class with the given row ID
            $export = new ExportExc($rowId);

            // Call the exportPdf method to download the PDF file
            return $export->exportPdf();
        } catch (\Exception $e) {
            Log::error('Error exporting PDF: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while exporting the PDF file.'
            ], 500);
        }
    }
}
