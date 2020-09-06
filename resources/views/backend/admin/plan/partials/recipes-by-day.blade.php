<div class="row">
    <div class="col">
        <table class="table data-table font-xs recipes_by_day" id="recipes-by-day-datatable-{{$i}}" style="width: 100% !important; ">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th class="center;">Nombre</th>
                    <th>Tipo</th>
                    <th>Energia</th>
                    <th>Proteinas</th>
                    <th>Grasa</th>
                    <th>Carbohidratos</th>
                    <th>Colesterol</th>
                    <th class="not-export-col">Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="th-btn-order">
                        <a onclick="storeOrder(event,{{$i}})" rel="tooltip" title="Guardar Orden" href="" class="btn btn-sm btn-success ml-2">
                            <i class="fas fa-check-circle"></i>
                        </a>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div><!--col-->
</div><!--row-->
<div class="row mt-lg-2" id="div-total-by-day-{{$i}}">

</div>


