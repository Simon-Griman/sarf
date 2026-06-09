<!DOCTYPE html>
<html>
<head>
    <title>parcela {{ $parcela->cargamento->operacion->nombre }}</title>
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
                <td><b>Terminal Origen:</b> {{ $parcela->cargamento->terminalOrigen->nombre }}</td>
                <td><b>Terminal Destino:</b> 
                    @foreach ($parcela->terminalDestinos as $destino)
                        {{ $destino->nombre }}@if (!$loop->last), @endif
                    @endforeach
                </td>
                <td><b>Buque:</b> {{ $parcela->cargamento->buque }}</td>
            </tr>
            <tr>
                <td><b>Nro Embarque:</b> {{ $parcela->cargamento->nro_embarque }}</td>
                <td><b>Fecha de Operación:</b> {{ \Carbon\Carbon::parse($parcela->cargamento->fecha_operacion)->format('d/m/Y') }}</td>
                <td><b>Nro viaje:</b> {{ $parcela->cargamento->nro_viaje }}</td>
            </tr>
            <tr>
                <td><b>Tipo de Operación:</b> {{ $parcela->cargamento->operacion->nombre }}</td>
                <td><b>Producto:</b> {{ $parcela->producto->nombre }}</td>
                <td><b>Volumen Nominal:</b> {{ number_format(($parcela->volumen), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><b>Compañía Inspectora:</b> SAMH</td>
                <td><b>Cantidad Determinada:</b> {{ $parcela->cargamento->cantidad_determinada }}</td>
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
                    $AyW = ($parcela->sediment_water * 100) / $parcela->TOV;
                    $densidad = cons1 / ($parcela->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $parcela->TOV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $parcela->TOV;   
                @endphp

                <td>TOV</td>
                <td>{{ number_format(($parcela->TOV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($parcela->TOV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($parcela->TOV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($parcela->sediment_water * 100) / $parcela->GOV;
                    $densidad = cons1 / ($parcela->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $parcela->GOV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $parcela->GOV;   
                @endphp
                
                <td>GOV</td>
                <td>{{ number_format(($parcela->GOV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($parcela->GOV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($parcela->GOV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($parcela->sediment_water * 100) / $parcela->GSV;
                    $densidad = cons1 / ($parcela->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $parcela->GSV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $parcela->GSV;   
                @endphp

                <td>GSV</td>
                <td>{{ number_format(($parcela->GSV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($parcela->GSV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($parcela->GSV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($parcela->sediment_water * 100) / $parcela->NSV;
                    $densidad = cons1 / ($parcela->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $parcela->NSV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $parcela->NSV;   
                @endphp

                <td>NSV</td>
                <td>{{ number_format(($parcela->NSV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($parcela->NSV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($parcela->NSV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
            </tr>
            <tr>
                @php
                    $AyW = ($parcela->sediment_water * 100) / $parcela->TCV;
                    $densidad = cons1 / ($parcela->API + cons2);
                    $api_seco = round((cons1 * (1 - ($AyW / 100)) / ($densidad - ($AyW / 100)) - cons2), 1);
                    $ftm = round((((cons3 / ($api_seco + cons2)) - cons4) * cons5), 5);
                    $tm = $ftm * $parcela->TCV;
                    $ftl = round((((cons3 / ($api_seco + cons2)) - cons4) * cons6), 5);
                    $tl = $ftl * $parcela->TCV;   
                @endphp

                <td>TCV</td>
                <td>{{ number_format(($parcela->TCV), 0, ',', '.') }}</td>
                <td>{{ number_format((round(($parcela->TCV / cons7), 3)), 3, ',', '.') }}</td>
                <td>{{ number_format(($parcela->TCV * 42), 2, ',', '.') }}</td>
                <td>{{ number_format((round($tl, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm, 4)), 4, ',', '.') }}</td>
                <td>{{ number_format((round($tm * 1000, 1)), 1, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Agua y Sedimento</td>
                <td>{{ number_format(($parcela->sediment_water), 0, ',', '.') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Agua Libre</td>
                <td>{{ number_format(($parcela->free_water), 0, ',', '.') }}</td>
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
                <td>{{ $parcela->producto->nombre }}</td>
                <td>{{ number_format(($parcela->API), 1, ',', '.') }}</td>
                <td>{{ number_format(($parcela->agua_sedimento), 2, ',', '.') }}</td>
                <td>{{ number_format(($parcela->temp), 1, ',', '.') }}</td>
                <td>{{ number_format(($parcela->azufre), 3, ',', '.') }}</td>
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
            @if($parcela->cargamento->operacion->nombre == 'Carga' || $parcela->cargamento->operacion->nombre == 'Importación')
            <tr>
                <td>OBQ: (CANTIDAD A BORDO)</td>
                <td>{{ number_format(($parcela->OBQ), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->OBQ / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>OBQ: CANTIDAD A BORDO (AGUA)</td>
                <td>{{ number_format(($parcela->OBQ_agua), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->OBQ_agua / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>TCV: DESPUES DE LA CARGA</td>
                <td>{{ number_format(($parcela->TCV_carga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->TCV_carga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>GSV: DESPUES DE LA CARGA</td>
                <td>{{ number_format(($parcela->GSV_carga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->GSV_carga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>NSV: DESPUES DE LA CARGA</td>
                <td>{{ number_format(($parcela->NSV_carga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->NSV_carga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>VEF</td>
                <td>{{ number_format(($parcela->VEF), 4, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TRV (TOTAL VOLUMEN RECIBIDO)</td>
                <td>{{ number_format(($parcela->TRV), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TRV AJUSTADO</td>
                <td>{{ number_format(($parcela->TRV_ajustado), 0, ',', '.') }}</td>
                <td></td>
            </tr>

            @elseif($parcela->cargamento->operacion->nombre == 'Descarga' || $parcela->cargamento->operacion->nombre == 'Exportación')
            <tr>
                <td>ROB: (REMANENTE A BORDO)</td>
                <td>{{ number_format(($parcela->ROB), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->ROB / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>ROB: REMANENTE A BORDO (AGUA)</td>
                <td>{{ number_format(($parcela->ROB_agua), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->ROB_agua / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>TCV: ANTES DE LA DESCARGA</td>
                <td>{{ number_format(($parcela->TCV_descarga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->TCV_descarga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>GSV: ANTES DE LA DESCARGA</td>
                <td>{{ number_format(($parcela->GSV_descarga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->GSV_descarga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>NSV: ANTES DE LA DESCARGA</td>
                <td>{{ number_format(($parcela->NSV_descarga), 0, ',', '.') }}</td>
                <td>{{ number_format((round($parcela->NSV_descarga / cons7, 3)), 3, ',', '.') }}</td>
            </tr>
            <tr>
                <td>VEF</td>
                <td>{{ number_format(($parcela->VEF), 4, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TDV (TOTAL VOLUMEN DESCARGADO)</td>
                <td>{{ number_format(($parcela->TDV), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>TDV AJUSTADO</td>
                <td>{{ number_format(($parcela->TDV_ajustado), 0, ',', '.') }}</td>
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
                @if($parcela->cargamento->operacion->nombre == 'Carga' || $parcela->cargamento->operacion->nombre == 'Importación')
                <th>TRV AJUSTADO (BUQUE)</th>
                @elseif($parcela->cargamento->operacion->nombre == 'Descarga' || $parcela->cargamento->operacion->nombre == 'Exportación')
                <th>TDV AJUSTADO (BUQUE)</th>
                @endif
                <th>DIFERENCIA (BBL)</th>
                <th>DIFERENCIA (%)</th>
            </tr>
        </thead>
        <tbody>
            <tr class="center">
                <td>{{ number_format((round($parcela->TCV, 0)), 0, ',', '.') }}</td>

                @if($parcela->cargamento->operacion->nombre == 'Carga' || $parcela->cargamento->operacion->nombre == 'Importación')
                <td>{{ number_format(($parcela->TRV_ajustado), 0, ',', '.') }}</td>
                @elseif($parcela->cargamento->operacion->nombre == 'Descarga' || $parcela->cargamento->operacion->nombre == 'Exportación')
                <td>{{ number_format(($parcela->TDV_ajustado), 0, ',', '.') }}</td>
                @endif

                @if($parcela->cargamento->operacion->nombre == 'Carga' || $parcela->cargamento->operacion->nombre == 'Importación')
                <td>{{ number_format(($parcela->TRV_ajustado - $parcela->TCV), 0, ',', '.') }}</td>
                <td>{{ number_format((($parcela->TRV_ajustado - $parcela->TCV) / $parcela->TCV) * 100, 2, ',', '.') }}</td>
                @elseif($parcela->cargamento->operacion->nombre == 'Descarga' || $parcela->cargamento->operacion->nombre == 'Exportación')
                <td>{{ number_format(($parcela->TDV_ajustado - $parcela->TCV), 0, ',', '.') }}</td>
                <td>{{ number_format(((($parcela->TDV_ajustado - $parcela->TCV) / $parcela->TCV) * 100), 2, ',', '.') }}</td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="qr-container">
        <img src="data:image/png;base64,{{ $qrcode }}">
    </div>
</body>
</html>