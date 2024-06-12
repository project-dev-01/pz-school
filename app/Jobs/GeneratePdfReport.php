<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PDF;
use Illuminate\Support\Facades\File;

class GeneratePdfReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $htmlContent;
    protected $fileName;
    protected $departmentId;

    public function __construct($htmlContent, $fileName, $departmentId)
    {
        $this->htmlContent = $htmlContent;
        $this->fileName = $fileName;
        $this->departmentId = $departmentId;
    }

    public function handle()
    {
        // Set custom paper size based on department_id
        if ($this->departmentId == 1) {
            $customPaper = [0, 0, 700.00, 920.00];
        } elseif ($this->departmentId == 2) {
            $customPaper = [0, 0, 700.00, 1000.00];
        } else {
            $customPaper = [0, 0, 700.00, 1000.00];
        }

        // Generate PDF from HTML content
        $pdf = PDF::loadHTML($this->htmlContent);
        $pdf->setPaper($customPaper);
        $pdfContent = $pdf->output();
        // $headers = [
		// 	'Content-Type' => 'application/pdf',
		// 	'Content-Length' => strlen($pdfContent)
		// ];
        // Define the storage path
        $storagePath = storage_path('app/reports');

        // Ensure the directory exists
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true, true);
        }

        // Save the PDF file
        file_put_contents("{$storagePath}/{$this->fileName}.pdf", $pdfContent);
    }
}
