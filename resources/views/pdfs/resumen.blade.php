<!DOCTYPE html>
<html>
<head>
    <title>Resumen {{ $resumen->operacion->nombre }}</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    @if (isset($cintilloClaro) && $cintilloClaro)
    <img src="{{ public_path('storage/' . $cintilloClaro) }}" alt="Cintillo Institucional" class="img">
    @else
    <img src="{{ public_path('storage/images/cintillos/Cintillo_claro.jpg') }}" alt="Cintillo Institucional" class="img">
    @endif

    <table>
        <thead>
            <tr class="title">
                <th colspan="3">Resumen del Cargamento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Terminal Origen:</b> {{ $resumen->terminalOrigen->nombre }}</td>
                <td><b>Terminal Destino:</b> {{ $resumen->terminalDestino->nombre }}</td>
                <td><b>Buque:</b> {{ $resumen->buque }}</td>
            </tr>
            <tr>
                <td><b>Nro Embarque:</b> {{ $resumen->nro_embarque }}</td>
                <td><b>Codigo SARF:</b></td>
                <td><b>Nro viaje:</b> {{ $resumen->nro_viaje }}</td>
            </tr>
            <tr>
                <td><b>Tipo de Operación:</b> {{ $resumen->operacion->nombre }}</td>
                <td><b>Producto:</b> {{ $resumen->producto->nombre }}</td>
                <td><b>Volumen Nominal:</b> {{ $resumen->volumen }}</td>
            </tr>
            <tr>
                <td><b>Compañía Inspectora:</b> SAMH</td>
                <td><b>Cantidad Determinada</b> {{ $resumen->cantidad_determinada }}</td>
                <td><b>Tipo de Documento:</b> {{ $resumen->documento }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Datos de tierra</h3>

    <table class="tierra">
        <thead>
            <tr>
                <th></th>
                <th>Bbls @ 60°F</th>
                <th>M3 @ 60°F</th>
                <th>US Gallons @ 60°</th>
                <th>Long Tons</th>
                <th>Metric Tons</th>
                <th>Kilogram</th>
            </tr>
        </thead>
        <tbody class="center">
            <tr>
                @php
                    $AyW = ($resumen->sediment_water * 100) / $resumen->TOV;
                    $densidad = cons1 / ($resumen->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $resumen->TOV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $resumen->TOV;   
                @endphp

                <td>TOV</td>
                <td>{{ $resumen->TOV }}</td>
                <td>{{ round(($resumen->TOV / cons7), 3) }}</td>
                <td>{{ number_format(($resumen->TOV * 42), 2, '.', '') }}</td>
                <td>{{ round($tl, 4) }}</td>
                <td>{{ round($tm, 4) }}</td>
                <td>{{ round($tm * 1000, 1) }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($resumen->sediment_water * 100) / $resumen->GOV;
                    $densidad = cons1 / ($resumen->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $resumen->GOV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $resumen->GOV;   
                @endphp
                
                <td>GOV</td>
                <td>{{ $resumen->GOV }}</td>
                <td>{{ round(($resumen->GOV / cons7), 3) }}</td>
                <td>{{ number_format(($resumen->GOV * 42), 2, '.', '') }}</td>
                <td>{{ round($tl, 4) }}</td>
                <td>{{ round($tm, 4) }}</td>
                <td>{{ round($tm * 1000, 1) }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($resumen->sediment_water * 100) / $resumen->GSV;
                    $densidad = cons1 / ($resumen->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $resumen->GSV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $resumen->GSV;   
                @endphp

                <td>GSV</td>
                <td>{{ $resumen->GSV }}</td>
                <td>{{ round(($resumen->GSV / cons7), 3) }}</td>
                <td>{{ number_format(($resumen->GSV * 42), 2, '.', '') }}</td>
                <td>{{ round($tl, 4) }}</td>
                <td>{{ round($tm, 4) }}</td>
                <td>{{ round($tm * 1000, 1) }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($resumen->sediment_water * 100) / $resumen->NSV;
                    $densidad = cons1 / ($resumen->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $resumen->NSV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $resumen->NSV;   
                @endphp

                <td>NSV</td>
                <td>{{ $resumen->NSV }}</td>
                <td>{{ round(($resumen->NSV / cons7), 3) }}</td>
                <td>{{ number_format(($resumen->NSV * 42), 2, '.', '') }}</td>
                <td>{{ round($tl, 4) }}</td>
                <td>{{ round($tm, 4) }}</td>
                <td>{{ round($tm * 1000, 1) }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($resumen->sediment_water * 100) / $resumen->TCV;
                    $densidad = cons1 / ($resumen->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $resumen->TCV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $resumen->TCV;   
                @endphp

                <td>TCV</td>
                <td>{{ $resumen->TCV }}</td>
                <td>{{ round(($resumen->TCV / cons7), 3) }}</td>
                <td>{{ number_format(($resumen->TCV * 42), 2, '.', '') }}</td>
                <td>{{ round($tl, 4) }}</td>
                <td>{{ round($tm, 4) }}</td>
                <td>{{ round($tm * 1000, 1) }}</td>
            </tr>
            <tr>
                <td>SEDIMIENT & WATER</td>
                <td>{{ $resumen->sediment_water }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>FREE WATER</td>
                <td>{{ $resumen->free_water }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <h3>Detalles de tierra</h3>

    <table class="tierra">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Tabla VCF</th>
                <th>Temp</th>
                <th>API</th>
            </tr>
        </thead>
        <tbody>
            <tr class="center">
                <td>{{ $resumen->producto->nombre }}</td>
                <td>{{ $resumen->tabla_VCF }}</td>
                <td>{{ $resumen->temp }}</td>
                <td>{{ $resumen->API }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Datos de Buque</h3>

    <table class="tierra">
        <thead>
            <tr>
                <th></th>
                <th>BBL @ 60°F</th>
                <th>M @ 15°C</th>
            </tr>
        </thead>
        <tbody class="center">
            @if($resumen->operacion->nombre == 'Carga' || $resumen->operacion->nombre == 'Importación')
            <tr>
                <td>OBQ: (CANTIDAD A BORDO)</td>
                <td>{{ $resumen->OBQ }}</td>
                <td>{{ round($resumen->OBQ / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>OBQ: CANTIDAD A BORDO (AGUA)</td>
                <td>{{ $resumen->OBQ_agua }}</td>
                <td>{{ round($resumen->OBQ_agua / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>TCV: DESPUES DE LA CARGA</td>
                <td>{{ $resumen->TCV_carga }}</td>
                <td>{{ round($resumen->TCV_carga / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>GSV: DESPUES DE LA CARGA</td>
                <td>{{ $resumen->GSV_carga }}</td>
                <td>{{ round($resumen->GSV_carga / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>NSV: DESPUES DE LA CARGA</td>
                <td>{{ $resumen->NSV_carga }}</td>
                <td>{{ round($resumen->NSV_carga / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>VEF</td>
                <td>{{ $resumen->VEF }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TRV (TOTAL VOLUMEN RECIBIDO)</td>
                <td>{{ $resumen->TRV }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TRV AJUSTADO</td>
                <td>{{ $resumen->TRV_ajustado }}</td>
                <td></td>
            </tr>

            @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
            <tr>
                <td>ROB: (REMANENTE A BORDO)</td>
                <td>{{ $resumen->ROB }}</td>
                <td>{{ round($resumen->ROB / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>ROB: REMANENTE A BORDO (AGUA)</td>
                <td>{{ $resumen->ROB_agua }}</td>
                <td>{{ round($resumen->ROB_agua / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>TCV: ANTES DE LA DESCARGA</td>
                <td>{{ $resumen->TCV_descarga }}</td>
                <td>{{ round($resumen->TCV_descarga / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>GSV: ANTES DE LA DESCARGA</td>
                <td>{{ $resumen->GSV_descarga }}</td>
                <td>{{ round($resumen->GSV_descarga / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>NSV: ANTES DE LA DESCARGA</td>
                <td>{{ $resumen->NSV_descarga }}</td>
                <td>{{ round($resumen->NSV_descarga / cons7, 3) }}</td>
            </tr>
            <tr>
                <td>VEF</td>
                <td>{{ $resumen->VEF }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TDV (TOTAL VOLUMEN DESCARGADO)</td>
                <td>{{ $resumen->TDV }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TDV AJUSTADO</td>
                <td>{{ $resumen->TDV_ajustado }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <h3>CONCILIACIÓN</h3>

    <table class="tierra">
        <thead>
            <tr>
                <th>TCV (TIERRA)</th>
                @if($resumen->operacion->nombre == 'Carga' || $resumen->operacion->nombre == 'Importación')
                <th>TRV AJUSTADO (BUQUE)</th>
                @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
                <th>TDV AJUSTADO (BUQUE)</th>
                @endif
                <th>DIFERENCIA (BBL)</th>
                <th>DIFERENCIA (%)</th>
            </tr>
        </thead>
        <tbody>
            <tr class="center">
                <td>{{ round($resumen->TCV, 0) }}</td>

                @if($resumen->operacion->nombre == 'Carga' || $resumen->operacion->nombre == 'Importación')
                <td>{{ $resumen->TRV_ajustado }}</td>
                @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
                <td>{{ $resumen->TDV_ajustado }}</td>
                @endif

                @if($resumen->operacion->nombre == 'Carga' || $resumen->operacion->nombre == 'Importación')
                <td>{{ $resumen->TRV_ajustado - $resumen->TCV }}</td>
                <td>{{ round((($resumen->TRV_ajustado - $resumen->TCV) / $resumen->TCV) * 100, 2) }}</td>
                @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
                <td>{{ $resumen->TDV_ajustado - $resumen->TCV }}</td>
                <td>{{ round(((($resumen->TDV_ajustado - $resumen->TCV) / $resumen->TCV) * 100), 2) }}</td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="qr-container">
        <img src="data:image/png;base64,{{ $qrcode }}">
    </div>
</body>
</html>