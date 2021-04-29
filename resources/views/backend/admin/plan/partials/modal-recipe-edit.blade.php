<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar Receta - {{ $recipe->name }} - <span style="color: orangered;">Rinde {{ $recipe->portions }} Porcion/es</span></h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-2">
                    {{ html()->label('Nuevo Nombre')
                                     ->class('col-md-12 form-control-label')
                                     ->for('new_name')
                                     ->style(['font-size'=>'13px'])}}
                </div>
                <div class="col-md-7">
                    {{ html()->text('new_name')
                            ->class('form-control')
                            ->placeholder('Nuevo Nombre')
                            ->attributes(['id'=>'new_name'])
                            ->required()
                            ->autofocus()
                    }}
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-md btn-success" onclick="updateNameRecipe(event)"><i class="fas fa-save"></i> Act. Nombre</a>
                </div>
            </div>
            <br>
            @include('backend.admin.recipe.partials.edit-ingredient')
            <p style="text-align: center; margin: 0;"><strong>Ingredientes</strong></p>
            @include('backend.admin.recipe.partials.datatable-ingredients')
            <div class="row mt-lg-2" id="divTotales"></div>

            <hr>
            @if(isset($array_dias))
                <div id="divAgregarReceta" style="border: 2px solid black; padding: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            {{ html()->label('Cant. de veces por día')
                                             ->class('col-md-12 form-control-label')
                                             ->style(['font-size'=>'13px'])}}
                        </div>
                        <div class="col-md-4">
                            {{ html()->label('Días Disponibles')
                                             ->class('col-md-12 form-control-label')
                                             ->style(['font-size'=>'13px'])}}
                        </div>
                        <div class="col-md-3                ">
                            {{ html()->label('Porciones para el Plan')
                                             ->class('col-md-12 form-control-label')
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
                        <div class="col-md-3">
                            {{ html()->number('portions',$recipe->portions)
                                                ->class('form-control')
                                                ->placeholder('Porciones para el plan')
                                                ->attribute('min', 1)
                                                ->attribute('max',100)
                                                ->attributes(['id'=>'portions'])
                                                ->required()
                                                ->autofocus()
                             }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <input type="hidden" id="hidden_recipe_id" name="hidden_recipe_id" value="{{$recipe->id}}">
        <input type="hidden" id="ingredient_id" name="ingredient_id">

        <div class="modal-footer">
            @if(isset($array_dias))
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                <button id="btnGuardar" class="btn btn-primary" type="button" onclick="storeRecipe(event,{{$recipe->id}})">Agregar</button>
            @else
                <button class="btn btn-secondary" type="button" data-dismiss="modal" onclick="actualizarDataTable(event,{{$day}},{{$plan_id}})">Cerrar</button>
            @endif
        </div>
    </div>
</div>



