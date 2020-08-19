@extends('backend.layouts.app')

@section('title', app_name() . ' | Agregar Recetas')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- roww and table -->
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-responsive-sm table-sm font-xs">
                    <thead>
                        <tr style="background-color: #20a8d8; color: white; ">
                            <th style="text-align: center;">Paciente</th>
                            <th style="text-align: center;">Plan</th>
                            <th style="text-align: center;" >Cant Días</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;" ><strong>{{$paciente->full_name}}</strong></td>
                            <td style="text-align: center;"><strong>{{$plan->name}}</strong></td>
                            <td style="text-align: center;"><strong>{{$plan->days}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end row and table -->
        @include('backend.admin.plan.partials.tabs-recipes-days')
    </div><!--card-body-->
</div><!--card-->

@endsection
<style>
    .select2-selection__choice{
     font-size: 11px;
    }
</style>
@push('after-scripts')
    @include('datatables.includes')
    <script>
        $(function () {
            getRecipes();
            iniciarDataTableRecetasAgregadas();
            iniciarDataTablesPordia();
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
                    var datos = data;
                    $("#divRecipes").empty().html(datos.html);
                    if(datos.cantidad < 9){
                        $("#divRecipes").css('height','').css('overflow-y','');
                    }
                    if(datos.cantidad > 9 && datos.cantidad < 15){
                        $("#divRecipes").css('height','400px').css('overflow-y','scroll');
                    }
                    if(datos.cantidad > 15){
                        $("#divRecipes").css('height','500px').css('overflow-y','scroll');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function iniciarDataTableRecetasAgregadas() {
            $('#recipes-datatable').DataTable({
                fixedHeader: true,
                paging:false,
                "scrollY": "250px",
                "scrollCollapse": true,
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons":[],
                "ordering": false,
                ajax: "{{ route('admin.plan.getRecipes',$plan->id) }}",
                columns: [
                    {data: null, defaultContent: '',render:function (row, type, val, meta) {
                            return  `<input type="checkbox" class="checkboxs" id= "detail_${row.id}" />`;
                        }
                    },
                    {data: 'recipe.name', name: 'recipe.name',},
                    {data: 'recipeType', name: 'recipeType',},
                    {data: 'classifications', name: 'classifications',},
                    {data: 'recipe.total_energia_kcal', name: 'recipe.total_energia_kcal',},
                    {data: 'recipe.total_proteina', name: 'recipe.total_proteina',},
                    {data: 'recipe.total_grasa_total', name: 'recipe.total_grasa_total',},
                    {data: 'recipe.total_carbohidratos_totales', name: 'recipe.total_carbohidratos_totales',},
                    {data: 'recipe.total_colesterol', name: 'recipe.total_colesterol',},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ],
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        }

        function iniciarDataTablesPordia() {
            @for($day=1;$day<=$plan->days;$day++)
                $('#recipes-by-day-datatable-{{$day}}').DataTable({
                    fixedHeader: true,
                    paging:false,
                    "scrollY": "250px",
                    "scrollCollapse": true,
                    "processing": true,
                    "serverSide": true,
                    "draw": true,
                    "buttons":[],
                    "ordering": false,
                    ajax: {
                        url: "{{ route('admin.plan.getRecipesByDay',$plan->id) }}",
                        data: function ( d ) {
                            d.day = "{{$day}}";
                        },
                    },
                    columns: [
                        {data: 'order', name: 'order', width: "10%" },
                        {data: 'plan_detail.recipe.name', name: 'plan_detail.recipe.name', width: "30%"},
                        {data: 'recipeType', name: 'recipeType',width: "10%"},
                        {data: 'plan_detail.recipe.total_energia_kcal', name: 'plan_detail.recipe.total_energia_kcal',},
                        {data: 'plan_detail.recipe.total_proteina', name: 'plan_detail.recipe.total_proteina',},
                        {data: 'plan_detail.recipe.total_grasa_total', name: 'plan_detail.recipe.total_grasa_total',},
                        {data: 'plan_detail.recipe.total_carbohidratos_totales', name: 'plan_detail.recipe.total_carbohidratos_totales',},
                        {data: 'plan_detail.recipe.total_colesterol', name: 'plan_detail.recipe.total_colesterol',},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                    ],
                });

                getTotalesPorDia("{{$day}}")
            @endfor
        }

        function getTotalesPorDia(day) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getTotalRecipesByDay',$plan->id) }}',
                type:     'POST',
                data:    {
                    'day': day,
                },
                success: function(data) {
                    var datos = data;
                    $(`#div-total-by-day-${day}`).empty().html(datos);
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
        function getTotalCompleto(event,recipe_id) {
            event.preventDefault();
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
                        // icon: 'info',
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

        function modalAgregarReceta(event,recipe_id,parametro = null) {
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
                    if(parametro === "ver"){
                        $("#modalRecipe .modal-footer").hide();
                    }
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
                        $("#modalRecipe").empty().html(datos.html);
                        iniciarJs();
                        limpiarModal();
                        $("#modalRecipe").modal('show');
                    }else{
                        $("#modalRecipe").modal('hide');
                    }
                    $("#recipes-datatable").DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    if(xhr.status === 422){
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
            var food_id = $("#edit_food_id").val();
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
                        title: '<strong>Composicion Completa Alimento</strong>',
                        // icon: 'info',
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

        function limpiarModal() {
            $("#edit_food_id").select2("val",0);
            $("#quantity_description").val("");
            $("#quantity_grs").val("");
            $("#ingredient_id").val("");
            $("#divComposicion").empty();
        }

        function eliminarIngrediente(event,ingredient_id) {
            event.preventDefault();

            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
                // icon: 'warning',
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
                        type:     'DELETE',
                        data:    {
                            'ingredient_id':ingredient_id,
                        },
                        success: function(data) {
                            var datos = data;
                            Lobibox.notify('success',{msg:datos.mensaje});
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

        function modificarIngrediente(event,ingredient_id) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.recipe.getIngredient') }}',
                type:     'POST',
                data:    {
                    'ingredient_id':ingredient_id,
                },
                success: function(data) {
                    var datos = data;
                    var $newOption = $("<option selected='selected'></option>").val(datos.ingredient.food_id).text(datos.food.name);
                    $("#edit_food_id").append($newOption).trigger('change');
                    $("#quantity_description").val(datos.ingredient.quantity_description);
                    $("#quantity_grs").val(datos.ingredient.quantity_grs);
                    $("#ingredient_id").val(datos.ingredient.id);
                },
                error: function(xhr, textStatus, errorThrown) {
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }

        function storeIngredient(event) {
            event.preventDefault();
            var food_id = $("#edit_food_id").val();
            var quantity_d = $("#quantity_description").val();
            var quantity_grs = $("#quantity_grs").val();
            var ingredient_id = $("#ingredient_id").val();

            if(food_id === null || food_id === undefined || food_id === ""){
                return Lobibox.notify('error',{msg:'Seleccione un alimento'});
            }
            if(quantity_d === null || quantity_d === undefined || quantity_d === ""){
                return Lobibox.notify('error',{msg:'Ingrese una descripcion de cantidades'});
            }
            if(quantity_grs === null || quantity_grs === undefined || quantity_grs === ""){
                return Lobibox.notify('error',{msg:'Ingrese la cantidad en grs'});
            }

            if(ingredient_id === null || ingredient_id === undefined || ingredient_id === ""){
                ingredient_id = 0;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('admin.recipe.addIngredients') }}',
                type:     'POST',
                data:    {
                    'food_id':food_id,
                    'quantity_description' : quantity_d,
                    'quantity_grs' :  quantity_grs,
                    'ingredient_id' : ingredient_id,
                    'recipe_id': $("#hidden_recipe_id").val(),
                },
                success: function(data) {
                    var datos = data;
                    Lobibox.notify('success',{msg: datos.mensaje});
                    limpiarModal();
                    $('#table-ingredients').DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }

        function verReceta(event,recipe_id) {
            modalAgregarReceta(event,recipe_id,"ver");
        }

        function eliminarReceta(event,plan_detail_id) {
            event.preventDefault();
            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
                // icon: 'warning',
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
                        url:      '{{ route('admin.plan.deleteDetail') }}',
                        type:     'DELETE',
                        data:    {
                            'id':plan_detail_id,
                        },
                        success: function(data) {
                            var datos = data;
                            Lobibox.notify('success',{msg:datos.mensaje});
                            $('#recipes-datatable').DataTable().ajax.reload();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                        }
                    });
                }
            });
        }

        function addPlanDetailDay(event) {
            event.preventDefault();
            var quantity_by_day = $("#quantity_by_day").val();
            var days = $("#days").val();
            var recipes =[];
            var all_recipes = $("input:checkbox.checkboxs");
            $.each(all_recipes,function (i,v) {
                if($(this).prop('checked')){
                    var id_split = $(this).attr('id').split('_');
                    recipes.push({
                        id: id_split[1],
                    });
                }
            })

            if(recipes.length === 0){
                return Lobibox.notify('error',{msg: "Seleccione al menos una receta"});
            }

            if(quantity_by_day <= 0 || quantity_by_day === "" || quantity_by_day === null || quantity_by_day === undefined){
                return Lobibox.notify('error',{msg: "Ingrese la cantidad de veces por día"});
            }

            if(days.length === 0 || days === "" || days === null || days === undefined){
                return Lobibox.notify('error',{msg: "Seleccione al menos un día"});
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.addPlanDetailDay') }}',
                type:     'POST',
                data:    {
                    'recipes':recipes,
                    'days':days,
                    'quantity_by_day' :quantity_by_day,
                    'plan_id': {{ $plan->id }}
                },
                success: function(data) {
                    var datos = data;
                    Lobibox.notify('success',{msg:datos.mensaje});
                    $("#quantity_by_day").val("");
                    $("#days").select2("val",0);
                    $('#recipes-datatable').DataTable().ajax.reload();
                    $.each(days,function (i,v) {
                        let day = parseInt(v);
                        $(`#recipes-by-day-datatable-${day}`).DataTable().ajax.reload();
                        getTotalesPorDia(day);
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function eliminarRecetaPorDia(event,plan_detail_day_id) {
            event.preventDefault();
            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
                // icon: 'warning',
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
                        url:      '{{ route('admin.plan.deleteDetailByDay') }}',
                        type:     'DELETE',
                        data:    {
                            'id':plan_detail_day_id,
                        },
                        success: function(data) {
                            var datos = data;
                            Lobibox.notify('success',{msg:datos.mensaje});
                            $(`#recipes-by-day-datatable-${datos.day}`).DataTable().ajax.reload();
                            getTotalesPorDia(datos.day);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                        }
                    });
                }
            });
        }

        function getTotalCompletoPlanPorDia(e,plan_id,day) {
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getTotalCompletoPlanPorDia') }}',
                type:     'POST',
                data:    {
                    'plan_id':plan_id,
                    'day':day
                },
                success: function(data) {
                    var datos = data;
                    Swal.fire({
                        title: '<strong>Total Completo Por Día</strong>',
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

        function storeOrder(e,plan_detail_day_id,day){
            e.preventDefault();
            var order = $(`#order_${plan_detail_day_id}`).val();
            if(order === null || order === 0 || order === undefined || order === ""){
                return Lobibox.notify('error',{msg: 'Ingrese el valor del orden.'});
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.storeOrderPlanDetailDay') }}',
                type:     'POST',
                data:    {
                    'id':plan_detail_day_id,
                    'order':order,
                },
                success: function(data) {
                    var datos = data;
                    Lobibox.notify('success',{msg:datos.mensaje});
                    $(`#recipes-by-day-datatable-${day}`).DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush


