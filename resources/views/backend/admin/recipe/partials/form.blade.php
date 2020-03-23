    <div class="row">
        {{ html()->label('Nombre')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}
        <div class="col-md-10">
            {{ html()->text('name')
                ->class('form-control')
                ->placeholder('Nombre')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
        </div><!--col-->

    </div>
    <br>
    <div class="row">
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
    <div class="row">
        {{ html()->label('Observaciones')
                    ->class('col-md-2 form-control-label')
                    ->for('observation') }}
        <div class="col-md-10">
            {{ html()->text('observation')
                ->class('form-control')
                ->placeholder('Observaciones')
                ->attribute('maxlength', 255)
                ->required()
                ->autofocus() }}
        </div><!--col-->
    </div>
