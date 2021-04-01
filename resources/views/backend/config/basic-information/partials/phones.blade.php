<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Código de Área')
                ->class('col-md-1 form-control-label')
                ->for('code_area') }}

            <div class="col-md-2">
                {{ html()->input('number','code_area')
                    ->class('form-control')
                    ->placeholder('Código de Área')
                    ->attribute('maxlength', 5)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
            {{ html()->label('Nro de Télefono')
               ->class('col-md-1 form-control-label')
               ->for('phone') }}

            <div class="col-md-3">
                {{ html()->input('number','phone')
                    ->class('form-control')
                    ->placeholder('Nro Télefono')
                    ->attribute('maxlength', 11)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
            <div class="col-md-1">
                <a href="#" class="btn btn-sm btn-success" onclick="storePhone(event)">Guardar</a>
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <table class="table data-table font-xs " id="phones-datatable" style="width: 100%;">
            <thead>
            <tr>
                <th>Código Área</th>
                <th>Nro de Teléfono</th>
                <th class="not-export-col">Acción</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
