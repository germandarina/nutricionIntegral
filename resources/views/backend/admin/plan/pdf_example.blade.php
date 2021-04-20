<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>PLAN DE PRUEBA - PACIENTE DE PRUEBA</title>
    <style>

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
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Helvetica Neue, sans-serif, sans-serif;
            font-size: 15px;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
            /*width: 18cm !important;*/
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        #logo_grande {
            text-align: center;
            margin-bottom: 10px;
            {{--background-image: {{ asset('img/ndf.png') }};--}}
        }

        #logo_grande img{
            width: 100%;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
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
        /*    padding: 5px;*/
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
    </style>
</head>
<body>
<header>

    <h1>Plan de Prueba <br>Paciente de Alimentación de Prueba</h1>
    <div>
        <table id="owner" style="width: 100%;">
            <tr>
                <td style="text-align: left;"><span>PACIENTE: </span> José Maria</td>
                <td style="text-align: right !important;">{{ $basic_information->full_name }} - {{ $basic_information->m_professional }}</td>
            </tr>
            <tr>
                <td style="text-align: left;"><span>EDAD: </span> 30</td>
                <td style="text-align: right !important;">{{ $basic_information->address }}</td>
            </tr>
            <tr>
                <td style="text-align: left;"><span>DIRECCIÓN: </span>  Calle sin nombre 123 </td>
                <td style="text-align: right !important;">{{ $basic_information->phones_front }}</td>
            </tr>
            <tr>
                <td style="text-align: left;"><span>FECHA: </span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                <td style="text-align: right !important;"><a href="mailto:{{ $basic_information->email }}">{{ $basic_information->email }}</a></td>
            </tr>
        </table>
        <hr>
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
        <h3 style="text-align: center; background-color: {!! $basic_information->color_days !!} ; padding: 3px; font-size: 30px !important;">DÍA {{ 1 }}</h3>
            <h3>DESAYUNO - OMELET DE JAMÓN Y QUESO</h3>
            <div>
                <table>
                    <thead>
                    <tr>
                        <th>INGREDIENTES</th>
                        <th>CANTIDADES</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: left; padding: 3px;">HUEVOS</td>
                            <td style="text-align: left; padding: 3px;">3 UNIDADES (30 grs)</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 1px;">QUESO CREMOSO</td>
                            <td style="text-align: left; padding: 1px;">2 FETAS (150 grs)</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 1px;">TOMATE</td>
                            <td style="text-align: left; padding: 1px;">3 RODAJAS (50 grs)</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: left;background-color: {!!  $basic_information->color_observations !!} ; padding: 3px;" colspan="2"><strong>OBSERVACIONES: condimentar a gusto con sal y pimienta. Acompañar con infusion a gusto.</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <hr>

            <h3>DESAYUNO - OMELET DE JAMÓN Y QUESO</h3>
            <div>
                <table>
                    <thead>
                    <tr>
                        <th>INGREDIENTES</th>
                        <th>CANTIDADES</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="text-align: left; padding: 3px;">HUEVOS</td>
                        <td style="text-align: left; padding: 3px;">3 UNIDADES (30 grs)</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; padding: 1px;">QUESO CREMOSO</td>
                        <td style="text-align: left; padding: 1px;">2 FETAS (150 grs)</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; padding: 1px;">TOMATE</td>
                        <td style="text-align: left; padding: 1px;">3 RODAJAS (50 grs)</td>
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


    @if($basic_information->textRecommendations->isNotEmpty() || $basic_information->imageRecommendations->isNotEmpty())
        <div >
            <h3 style="text-align: center; background-color: {!!  $basic_information->color_days !!}; padding: 3px; font-size: 30px !important;">RECOMENDACIONES</h3>

            @if($basic_information->textRecommendations->isNotEmpty())
                <div>
                    <ul style="font-size: 20px;">
                        @foreach($basic_information->textRecommendations as $recommendation)
                            <li><strong>{{ $recommendation->recommendation }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($basic_information->imageRecommendations->isNotEmpty())
                @foreach($basic_information->imageRecommendations as $recommendation)
                    <div id="logo_grande">
                        <img src="{{ public_path("img/backend/client/{$recommendation->recommendation}") }}" >
                    </div>
                    <div style="page-break-after: always;"></div>
                @endforeach
            @endif
        </div>
    @endif

</main>
</body>
</html>
