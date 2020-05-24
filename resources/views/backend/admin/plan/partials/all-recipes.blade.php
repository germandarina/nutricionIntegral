<div class="row">
    <div class="col-md-3">
        {{ html()->number('quantity_per_day')
                            ->class('form-control')
                            ->placeholder('Cant. de veces por día')
                            ->attribute('min', 1)
                            ->attribute('max',2)
                            ->required()
                            ->autofocus()
         }}
    </div>
    <div class="col-md-1">
        {{ html()->label('Días')
                         ->class('col-md-12 form-control-label')
                         ->for('classification_id')
                         ->style(['font-size'=>'13px'])}}
    </div>
    <div class="col-md-4">
        {{ html()->multiselect('days',$array_dias,[])
                        ->class('form-control')
                        ->required()
        }}
    </div><!--col-->
    <div class="col-2">
        <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> Asignar Días</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table data-table font-xs" id="recipes-datatable" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th class="not-export-col"></th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Clasificación</th>
                        <th>Energia</th>
                        <th>Proteinas</th>
                        <th>Grasa</th>
                        <th>Carbohidratos</th>
                        <th>Colesterol</th>
                        <th class="not-export-col">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div><!--col-->
</div><!--row-->


