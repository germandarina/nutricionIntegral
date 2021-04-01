    <div class="row">
        {{ html()->label('Nombre')
                    ->class('col-md-1 form-control-label')
                    ->for('name') }}
        <div class="col-md-4">
            {{ html()->text('name')
                ->class('form-control')
                ->placeholder('Nombre')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
        </div><!--col-->
        {{ html()->label('Grupo de Alimentos')
                   ->class('col-md-1 form-control-label')
                   ->for('name') }}
        <div class="col-md-4">
            {{ html()->select('food_group_id',\App\Models\FoodGroup::all()->pluck('name','id'))
                ->class('form-control')
                ->placeholder('Seleccione...')
                ->required()
                }}
        </div><!--col-->
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <h5 class="card-title mb-0">
                <small class="text-muted"><strong>Composición</strong><span style="color:red; font-size: 12px;">&nbsp;&nbsp; * Calculado por 100 gramos de porción comestible. Diferencia  = 100 - (agua + proteína + lípidos + cenizas). </span></small>
            </h5>
        </div><!--col-->
    </div><!--row-->
    <hr>
    @include('backend.config.food.partials.composicion')
