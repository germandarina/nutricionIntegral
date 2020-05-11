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
            <div class="col-md-8">
                {{ html()->text('recipe_name')
                    ->class('form-control')
                    ->placeholder('Buscar recetas por nombre...')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus()
                    ->attributes(['onblur'=>'getRecipes()']) }}
            </div><!--col-->
            <div class="col-md-2">
                {{ html()->number('min_calorias','min_calorias')
                    ->class('form-control')
                    ->placeholder('Min Calorias')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus()
                    ->attribute('min', 0)
                    ->attributes(['onchange'=>'getRecipes()'])}}
            </div><!--col-->
            <div class="col-md-2">
                {{ html()->number('max_calorias','max_calorias')
                    ->class('form-control')
                    ->placeholder('Max Calorias')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus()
                    ->attribute('min', 0)
                    ->attributes(['onchange'=>'getRecipes()'])}}
            </div><!--col-->
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<hr>
<div class="row" style="height: 500px;overflow-y: scroll;" id="divRecipes">

</div>
@push('after-scripts')
    <script>
        $(function () {
           getRecipes();
        });
        function getRecipes() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getRecipesForPlan') }}',
                type:     'POST',
                data: {
                    'foods': $("#food_id").val(),
                    'food_groups': $("#food_group_id").val(),
                    'classifications': $("#classification_id").val(),
                    'recipe_types' : $("#recipe_type_id").val(),
                    'recipe_name' : $("#recipe_name").val(),
                    'min_calorias' : $("#min_calorias").val(),
                    'max_calorias' : $("#max_calorias").val(),
                },
                success: function(data) {
                    $("#divRecipes").empty().html(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
        function getTotalCompleto(id_recipe,e) {
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.recipe.getTotalCompleto') }}',
                type:     'POST',
                data:    {
                    'id_recipe': id_recipe,
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


