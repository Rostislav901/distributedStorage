<?php

namespace App\Storage\Domain\File;

use setasign\Fpdi\Tcpdf\Fpdi;

class PdfFile extends AbstractBaseFile
{
    public function getContent(): string
    {
        $fileContent = file_get_contents($this->filePath);
        $blobContent = bin2hex($fileContent);

        $pdf = new Fpdi();
        $pdf->setSourceFile($blobContent); // Use hex-encoded content directly

        $pageCount = $pdf->getNumPages();
        for ($i = 1; $i <= $pageCount; ++$i) {
            $templateId = $pdf->importPage($i);
            $pdf->AddPage();
            $pdf->useTemplate($templateId);
        }

        $newPdfContent = $pdf->Output('', 'S');
        file_put_contents(__DIR__.'/recreated_pdf.pdf', $newPdfContent);
    }
}
