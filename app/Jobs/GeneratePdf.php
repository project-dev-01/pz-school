<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PDF;
use Illuminate\Support\Facades\Storage;

class GeneratePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $htmlContent;
    protected $fileName;
    /**
     * Create a new job instance.
     */
    public function __construct($htmlContent, $fileName)
    {
        $this->htmlContent = $htmlContent;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
         // Load HTML content
         $pdf = PDF::loadHtml($this->htmlContent);

         // Render the PDF
         $pdf->render();
 
         // Store the PDF to the storage
         Storage::put('pdfs/' . $this->fileName, $pdf->output());
    }
}
