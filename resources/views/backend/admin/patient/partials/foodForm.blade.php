<div class="fade-in">
    <div class="row mt-4">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Alimentos que no consumo')
                    ->class('col-md-3 form-control-label')
                    ->for('food_id') }}
                <div class="col-md-6">
                    {{ html()->multiselect('food_id',\App\Models\Food::all()->pluck('name','id'))
                        ->class('form-control')
                        ->required()
                         }}
                </div><!--col-->
            </div><!--form-group-->
            <div class="form-group row">
                {{ html()->label('Grupo de alimentos que no consumo')
                    ->class('col-md-3 form-control-label')
                    ->for('name') }}

                <div class="col-md-6">
                    {{ html()->multiselect('food_group_id',\App\Models\FoodGroup::all()->pluck('name','id'))
                        ->class('form-control')
                        ->required()
                         }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
</div>
