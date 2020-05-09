<div class="row" style="background-color: #d8e6f1;">
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
<div class="row"  style="background-color: #d8e6f1; padding: 10px;">
    <div class="col">
        <div class="form-group row">
            <div class="col-md-8">
                {{ html()->text('receta_name')
                    ->class('form-control')
                    ->placeholder('Buscar recetas por nombre, ingrediente,etc')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
            <div class="col-md-2">
                {{ html()->number('number','min_calorias')
                    ->class('form-control')
                    ->placeholder('Min Calorias')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
            <div class="col-md-2">
                {{ html()->input('number','max_calorias')
                    ->class('form-control')
                    ->placeholder('Max Calorias')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<hr>
<div class="row" style="height: 500px;overflow-y: scroll;">
    @foreach($recipes as $recipe)
        <div class="col-sm-4 mb-3" style="max-height: 30%;">
            <div class="card" style="margin-bottom: 0px !important;">
                <div class="accordion" id="accordion" role="tablist">
                    <div class="card-header" id="header_{{$recipe->id}}" role="tab" style="font-size: 11px; padding: 7px;">
                        <a rel="tooltip" title="{{$recipe->name}}"
                           data-toggle="collapse"
                           href="#collapse_{{$recipe->id}}"
                           aria-expanded="true"
                           aria-controls="collapse_{{$recipe->id}}"
                           class="">{{substr($recipe->name,0,35)}}</a>
                        <div class="card-header-actions">
                            <a class="btn btn-sm btn-success" href="#">
                                <icon class="fas fa-plus-square"></icon>
                            </a>
                            <a class="btn btn-sm btn-warning" href="#">
                                <icon class="fas fa-pencil-alt"></icon>
                            </a>
                        </div>
                    </div>
                    <div class="collapse" id="collapse_{{$recipe->id}}" role="tabpanel" aria-labelledby="header_{{$recipe->id}}" data-parent="#accordion" style="">
                        <div class="card-body" style="padding: 3px;">
                            <ul class="list-group">
                                <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Energía<span class="badge badge-info badge-pill">{{$recipe->total_energia_kcal }}</span></li>
                                <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Proteína<span class="badge badge-info badge-pill">{{$recipe->total_proteina}}</span></li>
                                <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Grasa<span class="badge badge-info badge-pill">{{$recipe->total_grasa_total}}</span></li>
                                <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Carbohidratos<span class="badge badge-info badge-pill">{{$recipe->total_carbohidratos_totales}}</span></li>
                                <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Colesterol<span class="badge badge-info badge-pill">{{$recipe->total_colesterol}}</span></li>
                                <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">
                                    <a href="#" class="btn btn-xs btn-success btn-block" onclick="getTotalCompleto(event)">TOTAL COMPOSICION RECETA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@push('after-scripts')
    <script>
        function getTotalCompleto(e) {
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.recipe.getTotalCompleto') }}',
                type:     'POST',
                data:    {
                    'id_recipe': "{{$recipe->id}}",
                },
                success: function(data) {
                    var datos = data;
                    Swal.fire({
                        title: '<strong>Total Composicion Receta</strong>',
                        icon: 'info',
                        html: datos,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '',
                        cancelButtonAriaLabel: 'Thumbs down'
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush


