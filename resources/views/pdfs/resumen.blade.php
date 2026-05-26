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
                <td><b>Fecha de Operación:</b> {{ \Carbon\Carbon::parse($resumen->fecha_operacion)->format('d/m/Y') }}</td>
                <td><b>Nro viaje:</b> {{ $resumen->nro_viaje }}</td>
            </tr>
            <tr>
                <td><b>Tipo de Operación:</b> {{ $resumen->operacion->nombre }}</td>
                <td><b>Producto:</b> {{ $resumen->producto->nombre }}</td>
                <td><b>Volumen Nominal:</b> {{ number_format(($resumen->volumen), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><b>Compañía Inspectora:</b> SAMH</td>
                <td><b>Cantidad Determinada</b> {{ $resumen->cantidad_determinada }}</td>
                <td><b>Tipo de Documento:</b> Definitivo</td>
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
                <td>{{ number_format(($resumen->TOV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($resumen->TOV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($resumen->TOV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
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
                <td>{{ number_format(($resumen->GOV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($resumen->GOV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($resumen->GOV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
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
                <td>{{ number_format(($resumen->GSV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($resumen->GSV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($resumen->GSV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
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
                <td>{{ number_format(($resumen->NSV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($resumen->NSV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($resumen->NSV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
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
                <td>{{ number_format(($resumen->TCV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($resumen->TCV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($resumen->TCV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Agua y Sedimento</td>
                <td>{{ number_format(($resumen->sediment_water), 0, ',', '.') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Agua Libre</td>
                <td>{{ number_format(($resumen->free_water), 0, ',', '.') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <h3>Calidades</h3>

    <table class="tierra">
        <thead>
            <tr>
                <th>Producto</th>
                <th>API</th>
                <th>% Agua y Sedimento</th>
                <th>Temp</th>
                <th>% Azufre</th>
            </tr>
        </thead>
        <tbody>
            <tr class="center">
                <td>{{ $resumen->producto->nombre }}</td>
                <td>{{ number_format(($resumen->API), 1, ',', '.') }}</td>
                <td>{{ number_format(($resumen->agua_sedimento), 2, ',', '.') }}</td>
                <td>{{ number_format(($resumen->temp), 1, ',', '.') }}</td>
                <td>{{ number_format(($resumen->azufre), 3, ',', '.') }}</td>
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
                <td>{{ number_format(($resumen->OBQ), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->OBQ / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>OBQ: CANTIDAD A BORDO (AGUA)</td>
                <td>{{ number_format(($resumen->OBQ_agua), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->OBQ_agua / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>TCV: DESPUES DE LA CARGA</td>
                <td>{{ number_format(($resumen->TCV_carga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->TCV_carga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>GSV: DESPUES DE LA CARGA</td>
                <td>{{ number_format(($resumen->GSV_carga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->GSV_carga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>NSV: DESPUES DE LA CARGA</td>
                <td>{{ number_format(($resumen->NSV_carga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->NSV_carga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>VEF</td>
                <td>{{ number_format(($resumen->VEF), 4, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TRV (TOTAL VOLUMEN RECIBIDO)</td>
                <td>{{ number_format(($resumen->TRV), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TRV AJUSTADO</td>
                <td>{{ number_format(($resumen->TRV_ajustado), 0, ',', '.') }}</td>
                <td></td>
            </tr>

            @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
            <tr>
                <td>ROB: (REMANENTE A BORDO)</td>
                <td>{{ number_format(($resumen->ROB), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->ROB / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>ROB: REMANENTE A BORDO (AGUA)</td>
                <td>{{ number_format(($resumen->ROB_agua), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->ROB_agua / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>TCV: ANTES DE LA DESCARGA</td>
                <td>{{ number_format(($resumen->TCV_descarga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->TCV_descarga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>GSV: ANTES DE LA DESCARGA</td>
                <td>{{ number_format(($resumen->GSV_descarga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->GSV_descarga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>NSV: ANTES DE LA DESCARGA</td>
                <td>{{ number_format(($resumen->NSV_descarga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($resumen->NSV_descarga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>VEF</td>
                <td>{{ number_format(($resumen->VEF), 4, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TDV (TOTAL VOLUMEN DESCARGADO)</td>
                <td>{{ number_format(($resumen->TDV), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TDV AJUSTADO</td>
                <td>{{ number_format(($resumen->TDV_ajustado), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <h3>Conciliación</h3>

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
                <td>{{ number_format((round($resumen->TCV, 0)), 0, ',', '.') }}</td>

                @if($resumen->operacion->nombre == 'Carga' || $resumen->operacion->nombre == 'Importación')
                <td>{{ number_format(($resumen->TRV_ajustado), 0, ',', '.') }}</td>
                @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
                <td>{{ number_format(($resumen->TDV_ajustado), 0, ',', '.') }}</td>
                @endif

                @if($resumen->operacion->nombre == 'Carga' || $resumen->operacion->nombre == 'Importación')
                <td>{{ number_format(($resumen->TRV_ajustado - $resumen->TCV), 0, ',', '.') }}</td>
                <td>{{ number_format((($resumen->TRV_ajustado - $resumen->TCV) / $resumen->TCV) * 100, 2, ',', '.') }}</td>
                @elseif($resumen->operacion->nombre == 'Descarga' || $resumen->operacion->nombre == 'Exportación')
                <td>{{ number_format(($resumen->TDV_ajustado - $resumen->TCV), 0, ',', '.') }}</td>
                <td>{{ number_format(((($resumen->TDV_ajustado - $resumen->TCV) / $resumen->TCV) * 100), 2, ',', '.') }}</td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="qr-container">
        <img src="data:image/png;base64,{{ $qrcode }}">
    </div>
</body>
</html>