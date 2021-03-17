<div>
    <table>
        <tbody>
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-3 offset-3">
                        <div  class="div_color" id="color-day" style="border: 1px solid darkgrey; width: 100%; height: 100%; cursor: pointer;" rel="tooltip" title="Seleccione un color"></div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="value_day" class="form-control" value="{{ $basic_information->color_days }}" readonly>
                    </div>
                </div>
            </td>
            <td style="width: 75%;">
                <p style="margin-left: 2%;">Seleccione el color de fondo de los días</p>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-3 offset-3">
                        <div class="div_color" id="color-header" style="border: 1px solid darkgrey; width: 100%; height: 100%; cursor: pointer;" rel="tooltip" title="Seleccione un color"></div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="value_header" class="form-control" value="{{ $basic_information->color_headers }}" readonly>
                    </div>
                </div>
            </td>
            <td>
                <p style="margin-left: 2%;">Seleccione el color de fondo de la cabecera (Ingrediente y Cantidad)</p>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-3 offset-3">
                        <div class="div_color" id="color-observations" style="border: 1px solid darkgrey; width: 100%; height: 100%; cursor: pointer;" rel="tooltip" title="Seleccione un color"></div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="value_observations" class="form-control" value="{{ $basic_information->color_observations }}" readonly>
                    </div>
                </div>
            </td>
            <td>
                <p style="margin-left: 2%;">Seleccione el color de fondo de las observaciones</p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <a href="#" class="btn btn-sm btn-success" onclick="storeColors(event)">Guardar Colores</a>
        <a id="download-plan" href="{{ route('admin.basic-information.downloadPlanExample',$basic_information->id) }}" class="btn btn-sm btn-primary" style="display: @if($basic_information->color_observations) inline-block @else none @endif">Descargar Plan de Ejemplo</a>
    </div>
</div>




