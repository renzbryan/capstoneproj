<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf as PdfWriter;
use App\Models\Iar;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ExportExc implements FromView
{
    protected $rowId;

    public function __construct($rowId)
    {
        $this->rowId = $rowId;
    }

    public function view(): View
    {
        try {
            // Load the Excel file template
            $spreadsheet = IOFactory::load(storage_path('app/IAR.xlsx'));
            
            // Retrieve the necessary data
            $data = Iar::find($this->rowId);
            $items = Item::where('iar_id', '=', $this->rowId)->get();
            
            // Populate the spreadsheet with data
            if ($data) {
                $spreadsheet->getActiveSheet()->setCellValue('D10', $data->iar_entityname);
                $spreadsheet->getActiveSheet()->setCellValue('I10', $data->iar_fundcluster);
                $spreadsheet->getActiveSheet()->setCellValue('C11', $data->iar_supplier);
                $spreadsheet->getActiveSheet()->setCellValue('E12', $data->iar_Podate);
                $spreadsheet->getActiveSheet()->setCellValue('E13', $data->iar_rod);
                $spreadsheet->getActiveSheet()->setCellValue('E14', $data->iar_rcc);
                $spreadsheet->getActiveSheet()->setCellValue('I11', $data->iar_number);
                $spreadsheet->getActiveSheet()->setCellValue('I12', $data->iar_date);
                $spreadsheet->getActiveSheet()->setCellValue('I13', $data->iar_invoice);
                $spreadsheet->getActiveSheet()->setCellValue('I14', $data->iar_invoice_d);
    
                // Iterate through items and populate the rows
                $row = 18;
                foreach ($items as $item) {
                    $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $item->item_name);
                    $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $item->item_unit);
                    $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $item->item_quantity);
                    $row++;
                }
            }
    
            return view('admin.iar.view-iar', ['spreadsheet' => $spreadsheet]);
    
        } catch (\Exception $e) {
            Log::error('Exception in view method: ' . $e->getMessage());
            throw $e;
        }
    }
    

    public function export()
    {
        try {
            $data = Iar::find($this->rowId);
            $spreadsheet = $this->view()->getData()['spreadsheet'];

            // Define path to save the Excel file
            $directoryPath = storage_path('IAR');
            $excelFilePath = $directoryPath . '/IAR_' . $this->rowId . '.xlsx';

            // Create the directory if it doesn't exist
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            // Save Excel file to local storage
            $writer = new Xlsx($spreadsheet);
            $writer->save($excelFilePath);

            // Return response to download the Excel file
            return response()->download($excelFilePath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Exception in ExportExc export method: ' . $e->getMessage());
            throw $e;
        }
    }

    public function exportPdf()
    {
        try {
            // Get the populated spreadsheet from the view method (same as Excel)
            $spreadsheet = $this->view()->getData()['spreadsheet'];
    
            // Set up PDF writer with the same spreadsheet
            $pdfWriter = new PdfWriter($spreadsheet);
    
            // Set paper size and orientation to match Excel settings
            $spreadsheet->getActiveSheet()->getPageSetup()
                ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
            $spreadsheet->getActiveSheet()->getPageSetup()
                ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
    
            // Output the PDF directly to the browser for viewing/printing
            ob_start();
            $pdfWriter->save('php://output');
            $pdfContent = ob_get_contents();
            ob_end_clean();
    
            return response()->make($pdfContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="IAR_' . $this->rowId . '.pdf"',
            ]);
    
        } catch (\Exception $e) {
            Log::error('Exception in exportPdf method: ' . $e->getMessage());
            throw $e;
        }
    }
    
    
}
