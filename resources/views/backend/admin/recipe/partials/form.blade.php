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
    <div class="row mt-2">
        {{ html()->label('Rinde')
                    ->class('col-md-2 form-control-label')
                    ->for('portions')
        }}

        <div class="col-md-3">
            {{ html()->input('number','portions',isset($recipe) ? $recipe->portions : 1)
                ->class('form-control')
                ->placeholder('Porciones')
                ->attribute('min', 1)
                ->attribute('max', 100)
                ->required()
                ->autofocus() }}
        </div><!--col-->
        <div>
            <label for="">Porcion/es</label>
        </div>
    </div>
