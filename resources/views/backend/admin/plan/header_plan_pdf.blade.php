<div id="logo">
{{--    <img src="{{ asset('img/ndf.png') }}" alt="">--}}
</div>
<h1>{{ strtoupper($plan->name) }}</h1>
<div>
    <table id="owner" style="width: 100%;">
        <tr>
            <td style="text-align: left;"><span>PACIENTE</span> {{ $patient->full_name }}</td>
            <td style="text-align: right !important;">Nutricion Deportiva Tucumán</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>EDAD</span> {{ $patient->birthdate->age }}</td>
            <td style="text-align: right !important;">General Paz 576 - 1er Piso</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>DIRECCION</span>{{$patient->address}}</td>
            <td style="text-align: right !important;">(0381)-575 31 79</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>FECHA</span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
            <td style="text-align: right !important;"><a href="mailto:benjaminkaramazov1991@gmail.com">benjaminkaramazov1991@gmail.com</a></td>
        </tr>
    </table>
    <hr>
    <div id="logo_grande">
        <img src="{{ public_path('img/ndf.png') }}" >
    </div>
</div>
<div style="page-break-after: always;"></div>
