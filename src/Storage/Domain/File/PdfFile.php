<?php
namespace App\Data\Domain\File;
use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF;

class PdfFile extends AbstractBaseFile
{

    function getContent(): string
    {
        $fileContent =  file_get_contents($this->fileContent);
        $blobContent = bin2hex($fileContent);

        $pdf = new Fpdi();
        $pdf->setSourceFile($blobContent); // Use hex-encoded content directly

        $pageCount = $pdf->getNumPages();
        for ($i = 1; $i <= $pageCount; $i++) {
            $templateId = $pdf->importPage($i);
            $pdf->AddPage();
            $pdf->useTemplate($templateId);
        }

        $newPdfContent = $pdf->Output('', 'S');
        file_put_contents(__DIR__ . '/recreated_pdf.pdf', $newPdfContent);

    }


}