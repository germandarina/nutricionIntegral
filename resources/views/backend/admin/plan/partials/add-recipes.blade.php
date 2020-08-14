<div class="row" style="background-color: #d8e6f1;">
    <div class="col-md-2">
        {{ html()->label('Clasificación')
                  ->class('col-md-12 form-control-label')
                  ->for('classification_id')
                  ->style(['font-size'=>'13px'])}}
        {{ html()->multiselect('classification_id',\App\Models\Classification::all()->pluck('name','id'),$classifications)
                        ->class('form-control')
                        ->required()
                        ->attributes(['onchange'=>'getRecipes()'])
        }}
    </div><!--col-->
    <div class="col-md-4">
        {{ html()->label('Grupo de alimento no consumidos')
                 ->class('col-md-12 form-control-label')
                 ->for('food_group_id')
                 ->style(['font-size'=>'13px'])}}
        {{ html()->multiselect('food_group_id',\App\Models\FoodGroup::all()->pluck('name','id'),$food_groups)
                        ->class('form-control')
                        ->required()
                        ->attributes(['onchange'=>'getRecipes()'])
        }}
    </div><!--col-->
    <div class="col-md-4">
        {{ html()->label('Alimentos no consumidos')
                 ->class('col-md-12 form-control-label')
                 ->for('food_id')
                 ->style(['font-size'=>'13px'])}}
        {{ html()->multiselect('food_id',\App\Models\Food::all()->pluck('name','id'),$foods)
                        ->class('form-control')
                        ->required()
                        ->attributes(['onchange'=>'getRecipes()'])
        }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Tipos de Recetas')
                ->class('col-md-12 form-control-label')
                ->for('recipe_type_id')
                ->style(['font-size'=>'13px'])}}
        {{ html()->multiselect('recipe_type_id',\App\Models\RecipeType::all()->pluck('name','id'),[])
                        ->class('form-control')
                        ->required()
                        ->attributes(['onchange'=>'getRecipes()'])
        }}
    </div>
</div>
<div class="row"  style="background-color: #d8e6f1; padding: 10px;">
    <div class="col">
        <div class="form-group row">
            <div class="col-md-6">
                <div class="input-group">
                    {{ html()->text('recipe_name')
                       ->class('form-control')
                       ->placeholder('Buscar recetas por nombre...')
                       ->attribute('maxlength', 191)
                       ->required()
                       ->autofocus()
                       ->attributes([])
                       ->child('<span class="input-group-addon"><a href="#" onclick="getRecipes()" class="btn btn-primary btn-lg" title="Buscar..." rel="tooltip"><i class="fas fa-search-plus"></i></a></span>')
                    }}
                </div>
            </div><!--col-->
            <div class="col-md-2">
                {{ html()->number('min_calorias','')
                    ->class('form-control')
                    ->placeholder('Min Calorias')
                    ->autofocus()
                    ->attribute('min', 0)
                    ->attributes(['onchange'=>'getRecipes()'])}}
            </div><!--col-->
            <div class="col-md-2">
                {{ html()->number('max_calorias','')
                    ->class('form-control')
                    ->placeholder('Max Calorias')
                    ->autofocus()
                    ->attribute('min', 0)
                    ->attributes(['onchange'=>'getRecipes()'])}}
            </div><!--col-->
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<hr>
<div class="row" id="divRecipes"></div>
@section('modal-yield')
    <div class="modal fade" id="modalRecipe" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>
@endsection

