    <div class="row">
        {{ html()->label('Nombre')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}
        <div class="col-md-10">
            {{ html()->text('name')
                ->class('form-control')
                ->placeholder('Nombre')
                ->attribute('maxlength', 200)
                ->attribute('minlength', 6)
                ->required()
                ->autofocus() }}
        </div><!--col-->

    </div>
    <div class="row mt-2">
        {{ html()->label('Tipo de Receta')
                   ->class('col-md-2 form-control-label')
                   ->for('name') }}
        <div class="col-md-4">
            {{ html()->select('recipe_type_id',\App\Models\RecipeType::all()->pluck('name','id'))
                ->class('form-control')
                ->placeholder('Seleccione...')
                ->required()
                }}
        </div><!--col-->
        {{ html()->label('Clasificacion')
                   ->class('col-md-2 form-control-label')
                   ->for('classifications') }}
        <div class="col-md-4">
            {{ html()->multiselect('classifications',\App\Models\Classification::all()->pluck('name','id'),isset($classifications) ? $classifications : null)
                ->class('form-control')
                ->required()
                }}
        </div><!--col-->
    </div>
    <div class="row mt-1">
        {{ html()->label('Observaciones')
                    ->class('col-md-2 form-control-label')
                    ->for('observation') }}
        <div class="col-md-8">
            {{ html()->multiselect('observations',\App\Models\Observation::all()->pluck('name','id'),isset($observations) ? $observations : null)
                ->class('form-control')
            }}
        </div><!--col-->
        <div>
            <a href="#" class="btn btn-success btn-xs btn-block" onclick="modalObservation(event)">Nueva Observación</a>
        </div>
    </div>

    @section('modal-yield')
        <div class="modal fade" id="modalObservation" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nueva Observación</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" id="bodyIngredients">
                        <div class="row mt-3">
                            <div class="col-sm-2">
                                <label for="">Nombre</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_observation" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                        <button id="btnObservation" class="btn btn-primary" type="button" onclick="storeObservation(event)">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
