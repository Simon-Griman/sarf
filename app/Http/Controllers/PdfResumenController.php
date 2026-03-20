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

        $resumen = Resumen::find($id);

        //constantes
        define('cons1', 141.5);
        define('cons2', 131.5);
        define('cons3', 141.3819577);
        define('cons4', 0.001199407795);
        define('cons5', 0.1589872949);
        define('cons6', 0.15647763335);
        define('cons7', 6.28981);

        //variables
        $AyW = ($resumen->sediment_water * 100) / $resumen->TOV;
        $densidad = cons1 / ($resumen->API + cons2);
        $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
        $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
        $tm = $ftm * $resumen->TOV;
        $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
        $tl = $ftl * $resumen->TOV;

        $data = [
            'titulo' => 'Reporte de Recurso',
            'qrcode' => $qrcode, // El string base64 generado arriba
            'resumen' => $resumen
        ];

        $pdf = Pdf::loadView('pdfs.resumen', $data);
        
        return $pdf->stream('archivo.pdf');
    }
}
