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
<div class="row" style="height: 500px;overflow-y: scroll;" id="divRecipes"></div>

@section('modal-yield')
    <div class="modal fade" id="modalRecipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true"></div>
@endsection
@push('after-scripts')

    <script>
        $(document).on('keypress',function(e) {
            return e.keyCode != 27;
        });
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
        function getTotalCompleto(e,recipe_id) {
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.recipe.getTotalCompleto') }}',
                type:     'POST',
                data:    {
                    'recipe_id': recipe_id,
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

        function modalAgregarReceta(event,recipe_id) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getModalRecipe') }}',
                type:     'POST',
                data:    {
                    'recipe_id': recipe_id,
                },
                success: function(data) {
                    var datos = data;
                    $("#modalRecipe").empty().html(datos).modal('show');
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function agregarReceta(event,recipe_id,edit) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.addRecipeToPlan') }}',
                type:     'POST',
                data:    {
                    'recipe_id': recipe_id,
                    'plan_id': "{{$plan->id}}",
                    'edit' : edit,
                },
                success: function(data) {
                    var datos = data;
                    Lobibox.notify('success',{msg: datos.mensaje });
                    if(edit === "1"){
                        $("#modalRecipe").empty().html(datos.html).modal('show');
                        iniciarJs();
                    }else{
                        $("#modalRecipe").modal('hide');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if(xhr.status == 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }

        function agregarYEditarReceta(event,recipe_id) {
            agregarReceta(event,recipe_id,'1');
        }

        function getComposicionBasica() {
            var food_id = $("#food_id").val();
            if(food_id != "" && food_id != null && food_id != undefined){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:      '{{ route('admin.food.getComposicion') }}',
                    type:     'POST',
                    data:    {
                        'food_id':food_id,
                    },
                    success: function(data) {
                        var datos = data;
                        $("#divComposicion").empty().html(datos);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                    }
                });
            }
        }

        function getComposicionCompleta(food_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.food.getComposicionCompleta') }}',
                type:     'POST',
                data:    {
                    'food_id':food_id,
                },
                success: function(data) {
                    var datos = data;
                    Swal.fire({
                        title: '<strong>Composicion Completa</strong>',
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

        function editIngredient(event,ingredient_id){

        }
        function deleteIngredient(event,ingredient_id){

        }

        function iniciarJs() {

            $('#edit_food_id').select2({
                placeholder: "Buscar alimentos...",
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('admin.recipe.searchIngredients') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term),
                            food_group_id: 0,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
            $("span.select2.select2-container.select2-container--default").css("width","100%");


            $('#table-ingredients').DataTable({
                "dom" : "",
                "processing": false,
                "serverSide": true,
                "draw": true,
                'paging':false,
                "info":     false,
                "buttons": [],
                ajax: {
                    url: "{{ route('admin.recipe.getIngredients') }}",
                    data: function ( d ) {
                        d.recipe_id = $("#hidden_recipe_id").val();
                    },
                },
                columns: [
                    {data: 'food.name', name: 'food.name',width:'40%'},
                    {data: 'quantity_description', name: 'quantity_description',width:'30%'},
                    {data: 'quantity_grs', name: 'quantity_grs',width:'20%'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,width:'1%'},
                ],
                "footerCallback": function( tfoot, data, start, end, display ) {
                    mostrarTotales();
                }
            });
        }

        function eliminarIngrediente(event,ingredient_id) {
            event.preventDefault();

            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText : 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      '{{ route('admin.recipe.deleteIngredient') }}',
                        type:     'POST',
                        data:    {
                            'ingredient_id':ingredient_id,
                        },
                        success: function(data) {
                            var datos = data;
                            Swal.fire(
                                datos.mensaje,
                                '',
                                'success'
                            );
                            $('#table-ingredients').DataTable().ajax.reload();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                        }
                    });
                }
            });
        }

        function mostrarTotales(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:   '{{ route('admin.recipe.getTotal') }}',
                type:  'POST',
                data:   {
                    'recipe_id': $("#hidden_recipe_id").val(),
                },
                success: function(data) {
                    $('#divTotales').empty().html(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush


