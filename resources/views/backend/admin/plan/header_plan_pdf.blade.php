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
            <td style="text-align: right !important;">General Paz 555 - 3ro A</td>
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
{{--        <p>{{ asset('img/ndf.png') }}</p>--}}
{{--        <p>{{ url('img/ndf.png') }}</p>--}}
{{--        <p>{{ public_path('img/ndf.png') }}</p>--}}
{{--        <p>"../img/ndf.png"</p>--}}
{{--        <p>"/public/img/ndf.png"</p>--}}
{{--        <p>"public/img/ndf.png"</p>--}}
{{--        <p>"assets/img/ndf.png"</p>--}}
{{--        <p>../../../../../public/img/ndf.png</p>--}}
{{--            <p>{{ base_path() }}/public/img/ndf.png"</p>--}}
{{--        <img src="{{ base_path() }}/public/img/ndf.png" />--}}


        <img src="../../../../../public/img/ndf.png" >
        <img src="../../../../../public/img/fondo.jpg" >

        <img src="{{ asset('img/ndf.png') }}" >
        <img src="{{ url('img/ndf.png') }}" >
        <img src="../img/ndf.png" >
        <img src="/public/img/ndf.png" >
        <img src="public/img/ndf.png" >
        <img src="assets/img/ndf.png" >
        <img src="{{ public_path('img/ndf.png') }}" >
        <img src="{{ public_path() .'img/ndf.png' }}">
        <img src="data:image/png;base64,{{$base_64}}" />


    </div>
</div>
<div style="page-break-after: always;"></div>
