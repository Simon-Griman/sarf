<?php

namespace App\Http\Controllers;

use App\Models\Cargamento;
use App\Models\Parcela;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfCargamentoController extends Controller
{
    public function generarDocumento($id)
    {
        $qrInfo = 'http://162.122.77.107/cargamento-pdf/'.$id;

        $qrcode = base64_encode(QrCode::format('png')->color(100, 100, 100)->size(100)->margin(1)->generate($qrInfo));

        //$cargamento = Cargamento::with(['parcelas.terminalDestinos', 'parcelas.producto'])->findOrFail($id);

        $parcela = Parcela::with(['cargamento', 'terminalDestinos', 'producto'])->findOrFail($id);

        //constantes
        define('cons1', 141.5);
        define('cons2', 131.5);
        define('cons3', 141.3819577);
        define('cons4', 0.001199407795);
        define('cons5', 0.1589872949);
        define('cons6', 0.15647763335);
        define('cons7', 6.28981);

        //variables
        /*$AyW = ($cargamento->sediment_water * 100) / $cargamento->TOV;
        $densidad = cons1 / ($cargamento->API + cons2);
        $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
        $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
        $tm = $ftm * $cargamento->TOV;
        $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
        $tl = $ftl * $cargamento->TOV;*/

        $data = [
            'titulo' => 'Reporte de Recurso',
            'qrcode' => $qrcode, // El string base64 generado arriba
            'parcela' => $parcela
        ];

        $pdf = Pdf::loadView('pdfs.cargamento', $data);

        return $pdf->stream('archivo.pdf');
    }
}
