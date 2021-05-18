<h1>{{ ucfirst(strtolower($plan->name)) }} <br> {{ucfirst($patient->full_name)}}</h1>
<div>
    <table id="owner" style="width: 100%;">
        <tr>
            <td style="text-align: left;"><span>PACIENTE: </span>{{ $patient->full_name }}</td>
            <td style="text-align: right !important;">{{ $basic_information->full_name }} - {{ $basic_information->m_professional }}</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>EDAD: </span> {{ $patient->birthdate->age }}</td>
            <td style="text-align: right !important;">{{ $basic_information->address }}</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>DIRECCIÓN: </span>  {{ $basic_information->address }} </td>
            <td style="text-align: right !important;">{{ $basic_information->phones_front }}</td>
        </tr>
        <tr>
            <td style="text-align: left;"><span>FECHA: </span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
            <td style="text-align: right !important;"><a href="mailto:{{ $basic_information->email }}">{{ $basic_information->email }}</a></td>
        </tr>
    </table>
    <div style="border: 2px dashed {!! $basic_information->color_days !!} ; padding: 10px;">
        <table>
            <tr>
                <td colspan="2" style="text-align: center">
                    <strong>FECHA ESTIMADA DEL PRÓXIMO CONTROL: {{ $next_date }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <strong>Recuerde solicitar el turno con anticipación.</strong>
                </td>
            </tr>
        </table>
    </div>
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
