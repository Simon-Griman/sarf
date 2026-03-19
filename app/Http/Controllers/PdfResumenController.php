<?php

namespace App\Http\Controllers;

use App\Models\Resumen;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfResumenController extends Controller
{
    public function generarDocumento($id)
    {
        $qrInfo = 'http://162.122.77.104/resumen-pdf/'.$id;

        $qrcode = base64_encode(QrCode::format('png')->color(100, 100, 100)->size(100)->margin(1)->generate($qrInfo));

        $data = [
            'titulo' => 'Reporte de Recurso',
            'qrcode' => $qrcode, // El string base64 generado arriba
            'resumen' => Resumen::find($id)
        ];

        $pdf = Pdf::loadView('pdfs.resumen', $data);
        
        return $pdf->stream('archivo.pdf');
    }
}
