<div class="row">
    <div class="col">
        <p style="font-size: 12px; margin-bottom: 0px;"><span class="badge rounded-pill recipe-edit">&nbsp;&nbsp;</span><strong>&nbsp;Recetas editadas</strong></p>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table data-table font-xs recipes_by_day" id="recipes-by-day-datatable-{{$i}}" style="width: 100% !important; ">
            <thead>
                <tr>
                    <th>Orden PDF</th>
                    <th class="center;">Nombre</th>
                    <th>Energía</th>
                    <th>Proteínas</th>
                    <th>Grasa</th>
                    <th>Carbohidratos</th>
                    @if ($plan->open)
                        <th class="not-export-col">Acciones</th>
                    @endif
                </tr>
            </thead>
            @if ($plan->open)
                <tfoot>
                    <tr>
                        <th class="th-btn-order">
                            <a onclick="storeOrder(event,{{$i}})" rel="tooltip" title="Guardar Orden" href="" class="btn btn-sm btn-success ml-2">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        </th>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div><!--col-->
</div><!--row-->
<div class="row mt-lg-2" id="div-total-by-day-{{$i}}">

</div>


