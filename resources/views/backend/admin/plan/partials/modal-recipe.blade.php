<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: none !important;">
            <h5 class="modal-title">{{ $recipe->name }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm table-sm table-condensed font-xs">
                     <thead>
                         <tr>
                             <th>Ingrediente</th>
                             <th style="text-align: right;">Cantidad (gr)</th>
                             <th style="text-align: center;">Descripción</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($recipe->ingredients as $ingredient)
                            <tr>
                                <td>{{$ingredient->food->name}}</td>
                                <td style="text-align: right;">{{$ingredient->quantity_grs}}</td>
                                <td style="text-align: center;">{{$ingredient->quantity_description}}</td>
                            </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
            <hr>
            @include('backend.admin.recipe.partials.table-total-recipe')
            <hr>
            <div id="divAgregarReceta" style="border: 1px solid #1abc9c; padding: 5px;">
                <div class="row">
                    <div class="col-md-4">
                        {{ html()->label('Cant. de veces por día')
                                         ->class('col-md-12 form-control-label')
                                         ->for('classification_id')
                                         ->style(['font-size'=>'13px'])}}
                    </div>
                    <div class="col-md-3                ">
                        {{ html()->label('Días Disponibles')
                                         ->class('col-md-12 form-control-label')
                                         ->for('classification_id')
                                         ->style(['font-size'=>'13px'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {{ html()->number('quantity_by_day')
                                            ->class('form-control')
                                            ->placeholder('')
                                            ->attribute('min', 1)
                                            ->attribute('max',4)
                                            ->attributes(['id'=>'quantity_by_day'])
                                            ->required()
                                            ->autofocus()
                         }}
                    </div>
                    <div class="col-md-4 offset-1">
                        {{ html()->multiselect('days',$array_dias,[])
                                        ->class('form-control')
                                        ->attributes(['id'=>'days'])
                                        ->required()
                        }}
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="hidden_plan_detail_id" id="hidden_plan_detail_id">

        <div class="modal-footer">
            <button class="btn btn-secondary btn-modal-create" type="button" data-dismiss="modal">Cerrar</button>
            <button id="btnGuardar" class="btn btn-primary btn-modal-create" type="button" onclick="storeRecipe(event,{{$recipe->id}})">Agregar</button>
            <button id="btnEditarEnCrear" class="btn btn-warning btn-modal-create" type="button" onclick="editRecipe(event,{{$recipe->id}})">Editar</button>

            <button id="btnEditar" class="btn btn-warning btn-modal-edit" style="display: none;" type="button" onclick="editRecipeAdded(event)">Editar Receta Agregada</button>
        </div>
    </div>
</div>



