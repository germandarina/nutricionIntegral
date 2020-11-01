
<h1>{{ ucfirst(strtolower($plan->name)) }} <br>{{ $basic_information->company_name }}</h1>
<div>
    <table id="owner" style="width: 100%;">
        <tr>
            <td style="text-align: left;"><span>PACIENTE</span> {{ $patient->full_name }}</td>
            <td style="text-align: right !important;">{{ $basic_information->full_name }} - {{ $basic_information->m_professional }}</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>EDAD</span> {{ $patient->birthdate->age }}</td>
            <td style="text-align: right !important;">{{ $basic_information->address }}</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>DIRECCION</span>{{$patient->address}}</td>
            <td style="text-align: right !important;">{{ $basic_information->phones_front }}</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>FECHA</span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
            <td style="text-align: right !important;"><a href="mailto:{{ $basic_information->email }}">{{ $basic_information->email }}</a></td>
        </tr>
    </table>
    <hr>
    <div id="logo_grande">
        <img src="{{ public_path("img/backend/client/{$basic_information->path_image}") }}" >
    </div>
</div>
<div style="page-break-after: always;"></div>
