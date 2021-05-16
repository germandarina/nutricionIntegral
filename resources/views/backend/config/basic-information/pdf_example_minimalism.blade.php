<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>PLAN DE PRUEBA - PACIENTE DE PRUEBA</title>
    <style>
        @media print {
            .element-that-contains-table {
                overflow: visible !important;
            }
        }
        .page {
            overflow: hidden;
            page-break-after: always;
        }

        .page:last-of-type {
            page-break-after: auto
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 23cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
            /*width: 18cm !important;*/
        }

        /*#logo {*/
        /*    text-align: center;*/
        /*    margin-bottom: 10px;*/
        /*}*/

        /*#logo img {*/
        /*    width: 90px;*/
        /*}*/

        #logo_grande {
            text-align: center;
            /*margin-bottom: 10px;*/
        {{--background-image: {{ asset('img/ndf.png') }};--}}
}

        #logo_grande img{
            width: 100%;
        }

        h1 {
            /*border-top: 1px solid  #5D6975;*/
            /*border-bottom: 1px solid  #5D6975;*/
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        h3.patient{
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center !important;
            margin: 0 0 20px 0;
        }

        #owner span {
            color: #5D6975;
            text-align: right;
            width: 85px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #owner td {
            white-space: nowrap;
            font-size: 20px !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            color: black;
            background-color: {{ $basic_information->color_headers }};
            white-space: nowrap;
            font-weight: bold;
            text-align: left;
        }

        /*table td {*/
        /*    padding: 3px;*/
        /*    text-align: right;*/
        /*}*/


        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        h3{
            margin-bottom: 0px !important;
        }

        td img
        {
            display: block;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .super-centered {
            position:absolute;
            width:100%;
            /*height:100%;*/
            text-align:center;
            vertical-align:middle;
            z-index: 9999;
        }

        .macros {
            font-size: 12px !important;
        }
    </style>
</head>
<body>
<header>
    <h1>Plan de Prueba Template Minimalista</h1>
    <h3 class="patient">Paciente de Prueba</h3>
    <div>
        <div style="border: 2px dashed {!! $basic_information->color_days !!} ; padding: 10px;">
            <table>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <strong>FECHA ESTIMADA DEL PRÓXIMO CONTROL: {{ Carbon\Carbon::now()->addMonth(1)->format('d/m/Y')  }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <strong>Recuerde solicitar el turno con anticipación.</strong>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div id="logo_grande">
            @if(!is_null($basic_information->path_image))
                <img src="{{ public_path("img/backend/client/{$basic_information->path_image}") }}" >
            @else
                <img src="{{ public_path("img/backend/diaita/diaita-large.png") }}" >
            @endif
        </div>
    </div>
    <div style="page-break-after: always;"></div>
</header>
<main>

    <div class="page">
        <h3 style="text-align: center; border-bottom: 3px solid {!! $basic_information->color_days !!}; color: {!! $basic_information->color_days !!}; padding: 3px; font-size: 30px!important;">Día 1</h3>
        <br>
            <div>
                <table style="width: 100%; border: 1px solid {!! $basic_information->color_headers !!};">
                    <thead style="display: table-header-group;">
                        <tr>
                            <th colspan="2" style="background-color: white; text-align: left; word-wrap: break-word; width: 65%;">
                                DESAYUNO - {{ "Rinde: 1 porción/es - Consumir: 1 porción/es" }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align: left; background-color: white;">
                                <span style="display: inline">
                                    DESAYUNO - OMELET DE JAMÓN Y QUESO
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th style="background-color: {!! $basic_information->color_headers !!}; padding: 3px; width: 65%;">INGREDIENTES</th>
                            <th style="background-color: {!! $basic_information->color_headers !!}; padding: 3px; width: 35%;">CANTIDADES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="page-break-inside: avoid;">
                            <td style="text-align: left; padding: 3px; width: 65%;">HUEVOS</td>
                            <td style="text-align: left; padding: 3px; width: 35%;">3 UNIDADES (30 grs)</td>
                        </tr>
                        <tr style="page-break-inside: avoid;">
                            <td style="text-align: left; padding: 3px; width: 65%;">QUESO CREMOSO</td>
                            <td style="text-align: left; padding: 3px; width: 35%;">2 FETAS (150 grs)</td>
                        </tr>
                        <tr style="page-break-inside: avoid;">
                            <td style="text-align: left; padding: 3px; width: 65%;">TOMATE</td>
                            <td style="text-align: left; padding: 3px; width: 35%;">3 RODAJAS (50 grs)</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: left;background-color: {!!  $basic_information->color_observations !!} ; padding: 3px;" colspan="2"><strong>OBSERVACIONES: condimentar a gusto con sal y pimienta. Acompañar con infusion a gusto.</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        <div>
            <table style="width: 100%; border: 1px solid {!! $basic_information->color_headers !!};">
                <thead style="display: table-header-group;">
                <tr>
                    <th colspan="2" style="background-color: white; text-align: left; word-wrap: break-word; width: 65%;">
                        DESAYUNO - {{ "Rinde: 1 porción/es - Consumir: 1 porción/es" }}
                    </th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: left; background-color: white;">
                                <span style="display: inline">
                                    DESAYUNO - OMELET DE JAMÓN Y QUESO
                                </span>
                    </th>
                </tr>
                <tr>
                    <th style="background-color: {!! $basic_information->color_headers !!}; padding: 3px; width: 65%;">INGREDIENTES</th>
                    <th style="background-color: {!! $basic_information->color_headers !!}; padding: 3px; width: 35%;">CANTIDADES</th>
                </tr>
                </thead>
                <tbody>
                <tr style="page-break-inside: avoid;">
                    <td style="text-align: left; padding: 3px; width: 65%;">HUEVOS</td>
                    <td style="text-align: left; padding: 3px; width: 35%;">3 UNIDADES (30 grs)</td>
                </tr>
                <tr style="page-break-inside: avoid;">
                    <td style="text-align: left; padding: 3px; width: 65%;">QUESO CREMOSO</td>
                    <td style="text-align: left; padding: 3px; width: 35%;">2 FETAS (150 grs)</td>
                </tr>
                <tr style="page-break-inside: avoid;">
                    <td style="text-align: left; padding: 3px; width: 65%;">TOMATE</td>
                    <td style="text-align: left; padding: 3px; width: 35%;">3 RODAJAS (50 grs)</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align: left;background-color: {!!  $basic_information->color_observations !!} ; padding: 3px;" colspan="2"><strong>OBSERVACIONES: condimentar a gusto con sal y pimienta. Acompañar con infusion a gusto.</strong></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


        <div>
            <h3 style="text-align: center; border-bottom: 3px solid {!! $basic_information->color_days !!}; color: {!! $basic_information->color_days !!}; padding: 3px; font-size: 30px !important;">RECOMENDACIONES</h3>

                <div>
                    <ul style="font-size: 20px;">
                        <li><strong>Recomendario de prueba: evite consumir alimentos ultraprocesados</strong></li>
                        <li><strong>Recomendario de prueba: evite consumir alimentos ultraprocesados</strong></li>
                        <li><strong>Recomendario de prueba: evite consumir alimentos ultraprocesados</strong></li>
                    </ul>
                </div>

            @if(!is_null($basic_information->path_image))
                <img src="{{ public_path("img/backend/client/{$basic_information->path_image}") }}" >
            @else
                <img src="{{ public_path("img/backend/diaita/diaita-large.png") }}" >
            @endif
            <div style="page-break-after: always;"></div>
        </div>
</main>
</body>
</html>
