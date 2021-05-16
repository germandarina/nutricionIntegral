<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr>
            <td>
                <div  class="div_color" id="color-day" style="border: 1px solid darkgrey; width: 35px; height: 35px; cursor: pointer;" rel="tooltip" title="Seleccione un color"></div>
            </td>
            <td>
                <input type="text" id="value_day" class="form-control" value="{{ $basic_information->color_days }}" readonly>
            </td>
            <td>
                <p style="margin-left: 2%;"><strong>Seleccione el color de fondo de los días</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <div class="div_color" id="color-header" style="border: 1px solid darkgrey; width: 35px; height: 35px; cursor: pointer;" rel="tooltip" title="Seleccione un color"></div>
            </td>
            <td>
                <input type="text" id="value_header" class="form-control" value="{{ $basic_information->color_headers }}" readonly>
            </td>
            <td>
                <p style="margin-left: 2%;"><strong>Seleccione el color de fondo de la cabecera (Ingrediente y Cantidad)</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <div class="div_color" id="color-observations" style="border: 1px solid darkgrey; width: 35px; height: 35px; cursor: pointer;" rel="tooltip" title="Seleccione un color"></div>
            </td>
            <td>
                <input type="text" id="value_observations" class="form-control" value="{{ $basic_information->color_observations }}" readonly>
            </td>
            <td>
                <p style="margin-left: 2%;"><strong>Seleccione el color de fondo de las observaciones</strong></p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <a href="#" class="btn btn-sm btn-success" onclick="storeColors(event)">Guardar Colores</a>
    </div>
</div>
<div class="form-group row mt-3">
    <label class="col-md-3 col-form-label"><strong>Templates Disponibles</strong></label>
    <div class="col-md-3 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="inline-minimalism" type="radio" value="minimalism" name="inline-radios">
            <label class="form-check-label" for="inline-minimalism"><strong>Minimalista</strong></label>
        </div>
        <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="inline-full-data" type="radio" value="full-data" name="inline-radios">
            <label class="form-check-label" for="inline-full-data"><strong>Full Datos</strong></label>
        </div>
{{--        <div class="form-check form-check-inline mr-1">--}}
{{--            <input class="form-check-input" id="inline-radio3" type="radio" value="option3" name="inline-radios">--}}
{{--            <label class="form-check-label" for="inline-radio3">Three</label>--}}
{{--        </div>--}}
    </div>
    <div class="col-md-3 col-form-label">
        <a id="download-plan" href="{{ route('config.basic-information.downloadPlanExample',$basic_information->id) }}" class="btn btn-sm btn-primary" style="display: @if($basic_information->color_observations) inline-block @else none @endif">Descargar Plan de Ejemplo</a>
    </div>
</div>




