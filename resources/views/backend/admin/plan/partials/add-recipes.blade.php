<div class="row">
    <div class="col-md-2">
        {{ html()->label('Clasificación')
                  ->class('col-md-12 form-control-label')
                  ->for('classification_id')
                  ->style(['font-size'=>'13px'])}}
        {{ html()->multiselect('classification_id',\App\Models\Classification::all()->pluck('name','id'),$classifications)
                        ->class('form-control')
                        ->required()
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
        }}
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="form-group row">
            <div class="col-md-12">
                {{ html()->text('name')
                    ->class('form-control')
                    ->placeholder('Buscar recetas por nombre, ingrediente,etc')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

<div class="row" style="height: 500px;overflow-y: scroll;">
    @foreach($recipes as $recipe)
        <div class="col-sm-3">
            <div class="card h-60">
                <div class="card-header" style="font-size: 12px;">{{$recipe->name}}
                    <div class="card-header-actions">
                        <a class="btn btn-sm btn-success" href="#">
                            <icon class="fas fa-plus-square"></icon>
                        </a>
                        <a class="btn btn-sm btn-warning" href="#">
                            <icon class="fas fa-pencil-alt"></icon>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    @endforeach
</div>


