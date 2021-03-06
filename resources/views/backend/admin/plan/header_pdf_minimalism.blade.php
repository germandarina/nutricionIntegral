<h1>{{ ucfirst(strtolower($plan->name)) }}</h1>
<h3 class="patient">{{ucfirst($patient->full_name)}}</h3>
<div>
    @if ($basic_information->show_frequency_days)
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
    @endif
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
