
<h1 style="text-align: center;">{{ ucfirst(strtolower($plan->name)) }} <br>{{ $basic_information->company_name }}</h1>
<div>
    <table>
        <tbody>
            <tr>
                <td colspan="2" style="text-align: center;">
                    {{ $basic_information->full_name }} - {{ $basic_information->m_professional }} -
                    {{ $basic_information->address }} -
                    {{ $basic_information->phones_front }}
                    <a href="mailto:{{ $basic_information->email }}">{{ $basic_information->email }}</a>
                </td>
            </tr>
            <tr>
                <td style="text-align: left; width: 300px !important;">PACIENTE</td>
                <td style="text-align: right !important;width: 50% !important;"><strong>{{ $patient->full_name }}</strong></td>
            </tr>
            <tr>
                <td style="text-align: left; width: 300px !important;">EDAD</td>
                <td style="text-align: right !important; width: 50% !important;"><strong>{{ $patient->birthdate->age }}</strong></td>
            </tr>
            <tr>
                <td style="text-align: left; width: 300px !important;">DIRECCION</td>
                <td style="text-align: right !important; width: 50% !important;"><strong>{{$patient->address}}</strong></td>
            </tr>
            <tr>
                <td style="text-align: left; width: 300px !important;">FECHA</td>
                <td style="text-align: right !important; width: 50% !important;"><strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></td>
            </tr>
        </tbody>
    </table>
    <hr>
{{--    <div id="logo_grande">--}}
{{--        @if(!is_null($basic_information->path_image))--}}
{{--            <img src="{{ public_path("img/backend/client/{$basic_information->path_image}") }}" >--}}
{{--        @else--}}
{{--            <img src="{{ public_path("img/backend/diaita/diaita-large.png") }}" >--}}
{{--        @endif--}}
{{--    </div>--}}
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
