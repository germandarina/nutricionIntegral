    <div class="row mt-4">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Nombre')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}
                <div class="col-md-6">
                    {{ html()->text('name')
                        ->class('form-control')
                        ->placeholder('Nombre')
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
            <div class="form-group row">
                {{ html()->label('Grupo de Alimentos')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}
                <div class="col-md-6">
                    {{ html()->select('food_group_id',\App\Models\FoodGroup::all()->pluck('name','id'))
                        ->class('form-control')
                        ->placeholder('Seleccione...')
                        ->required()
                        }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
