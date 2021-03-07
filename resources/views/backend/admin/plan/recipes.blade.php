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
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;" ><strong>{{$paciente->full_name}}</strong></td>
                            <td style="text-align: center;"><strong>{{$plan->name}}</strong></td>
                            <td style="text-align: center;"><strong>{{$plan->days}}</strong></td>
                            <th>{{ form_cancel(route('admin.plan.index'), __('buttons.general.cancel')) }}</th>
                            @if($plan->open)
                                <th><a href="#" class="btn btn-sm btn-warning" onclick="closePlan(event)">Cerrar Plan</a></th>
                            @else
                                <th><a href="#" class="btn btn-sm btn-warning" onclick="openPlan(event)">Re Abrir Plan</a></th>
                            @endif
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

    .recipe_used{
        border: 2px solid #ff8d7e;
        background-color: #ff8d7e;
    }

    .recipe_used_in_plan{
        border: 2px solid #7e80ff;
        background-color: #7e80ff;
    }

    .recipe-edit{
        background-color: #ffdd76;
    }
</style>
@push('after-scripts')
    @include('datatables.includes')
    <script>
        var procesando = null;

        $(function () {
            getRecipes();
            iniciarDataTablesPordia();
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });

        function getRecipes() {
            $("#divRecipes").LoadingOverlay("show", {
                background  : "rgba(165, 190, 100, 0.5)"
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getRecipesForPlan') }}',
                type:     'POST',
                data: {
                    'patient_id' : "{{ $plan->patient_id }}",
                    'plan_id'    : "{{ $plan->id }}",
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

                    $("#divRecipes").LoadingOverlay("hide", true);
                    $(".card-header").find("[rel=tooltip]").tooltip();
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function iniciarDataTablesPordia() {
            @for($day=1;$day<=$plan->days;$day++)

                $('#recipes-by-day-datatable-{{$day}}').DataTable({
                    dom: 'Brtp',
                    fixedHeader: true,
                    paging:false,
                    scrollY: "250px",
                    scrollCollapse: true,
                    processing: true,
                    serverSide: true,
                    draw: true,
                    buttons:[],
                    ordering: false,
                createdRow: function( row, data, dataIndex){
                    if(data.recipe.edit ===  1)
                        $(row).addClass('recipe-edit');
                        $(row).find("[rel=tooltip]").tooltip()
                    },
                    ajax: {
                        url: "{{ route('admin.plan.getRecipesByDay',$plan->id) }}",
                        data: function ( d ) {
                            d.day = "{{$day}}";
                        },
                    },
                    columns: [
                        {data: 'order', name: 'order', width: "15%" },
                        {data: 'recipe_name', name: 'recipe_name', width: "30%"},
                        {data: 'recipeType', name: 'recipeType',width: "10%"},
                        {data: 'recipe.total_energia_kcal', name: 'recipe.total_energia_kcal',},
                        {data: 'recipe.total_proteina', name: 'recipe.total_proteina',},
                        {data: 'recipe.total_grasa_total', name: 'recipe.total_grasa_total',},
                        {data: 'recipe.total_carbohidratos_totales', name: 'recipe.total_carbohidratos_totales',},
                        @if ($plan->open)
                            {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                        @endif
                    ],
                });

            $(".th-btn-order").find("[rel=tooltip]").tooltip();
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

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

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

                    procesando.remove();

                    Swal.fire({
                        title: '<strong>Total Composición Receta</strong>',
                        html: datos,
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        cancelButtonText: '',
                        cancelButtonAriaLabel: 'Thumbs down'
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function modalAgregarReceta(event,recipe_id,plan_detail_id = null) {
            event.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getModalRecipe') }}',
                type:     'POST',
                data:    {
                    'recipe_id': recipe_id,
                    'plan_id'  : "{{$plan->id}}"
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    $("#modalRecipe").empty().html(datos);
                    $("#days").select2({
                        minimumResultsForSearch: 5,
                        width: '100%',
                    });
                    $("#modalRecipe").modal('show');

                    if(plan_detail_id !== null){
                        $("#modalRecipe #hidden_plan_detail_id").val(plan_detail_id);
                        $("#divAgregarReceta").hide();
                        $("#modalRecipe .btn-modal-create").hide();
                        $("#modalRecipe .btn-modal-edit").show();
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function storeRecipe(event,recipe_id) {
            event.preventDefault();

            var quantity_by_day = $("#quantity_by_day").val();
            var days = $("#days").val();

            if(quantity_by_day <= 0 || quantity_by_day === "" || quantity_by_day === null || quantity_by_day === undefined){
                return Lobibox.notify('error',{msg: "Ingrese la cantidad de veces por día"});
            }

            if(days.length === 0 || days === "" || days === null || days === undefined){
                return Lobibox.notify('error',{msg: "Seleccione al menos un día"});
            }

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.addRecipeToPlan') }}',
                type:     'POST',
                data:    {
                    'recipe_id': recipe_id,
                    'plan_id': "{{$plan->id}}",
                    'quantity_by_day': quantity_by_day,
                    'days': days
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();

                    Lobibox.notify('success',{msg: datos.mensaje });
                    $("#modalRecipe").modal('hide');

                    $.each(days,function (i,v) {
                        let day = parseInt(v);
                        $(`#recipes-by-day-datatable-${day}`).DataTable().ajax.reload();
                        getTotalesPorDia(day);
                    })
                    getRecipes();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }

        function editRecipe(event,recipe_id) {
            event.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getRecipe') }}',
                type:     'POST',
                data:    {
                    'recipe_id': recipe_id,
                    'plan_id'  : "{{$plan->id}}"
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    $("#modalRecipe").empty().html(datos.html);
                    initJs();
                    cleanModal();
                    $("#modalRecipe").modal('show');
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });


        }

        function editRecipeAdded(event){
            event.preventDefault();
            var plan_detail_id =  $("#modalRecipe #hidden_plan_detail_id").val();

            if(plan_detail_id === "" && plan_detail_id === null && plan_detail_id === undefined)
                return Lobibox.notify('error',{msg:'Seleccione una receta'});

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.editRecipeAdded') }}',
                type:     'POST',
                data:    {
                    'plan_detail_id': plan_detail_id
                },
                success: function(data) {
                    var datos = data;

                    $(`#recipes-by-day-datatable-${datos.day}`).DataTable().ajax.reload();

                    procesando.remove();
                    $("#modalRecipe").empty().html(datos.html);
                    initJs();
                    cleanModal();
                    $("#modalRecipe").modal('show');
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function actualizarDataTable(event,day,plan_id)
        {
            event.preventDefault();
            $(`#recipes-by-day-datatable-${day}`).DataTable().ajax.reload();
            getTotalesPorDia(day)
        }

        function getComposicionBasica() {
            var food_id = $("#edit_food_id").val();
            if(food_id !== "" && food_id !== null && food_id !== undefined){
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

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

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
                    procesando.remove();
                    Swal.fire({
                        title: '<strong>Composición Completa</strong>',
                        // icon: 'info',
                        html: datos,
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        // confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
                        // confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '',
                        // cancelButtonAriaLabel: 'Thumbs down'
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function initJs() {

            $('#edit_food_id').select2({
                placeholder: "Buscar alimentos...",
                minimumInputLength: 2,
                language: {
                    noResults: function () {
                        return "No hay resultados";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function(a){
                        return"Por favor ingrese "+(a.minimum-a.input.length)+" o más caracteres"
                    }
                },
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

            $("#days").select2({
                minimumResultsForSearch: 5,
                width: '100%',
            });

            $("span.select2.select2-container.select2-container--default").css("width","100%");
        }

        function cleanModal() {
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
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText : 'No',
            }).then((result) => {
                if (result.value) {

                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

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
                            procesando.remove();
                            Lobibox.notify('success',{msg:datos.mensaje});
                            $('#table-ingredients').DataTable().ajax.reload();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            procesando.remove();
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

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

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
                    procesando.remove();
                    var $newOption = $("<option selected='selected'></option>").val(datos.ingredient.food_id).text(datos.food.name);
                    $("#edit_food_id").append($newOption).trigger('change');
                    $("#quantity_description").val(datos.ingredient.quantity_description);
                    $("#quantity_grs").val(datos.ingredient.quantity_grs);
                    $("#ingredient_id").val(datos.ingredient.id);
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
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

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

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
                    procesando.remove();
                    Lobibox.notify('success',{msg: datos.mensaje});
                    cleanModal();
                    $('#table-ingredients').DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }

        function showRecipe(event,recipe_id,plan_detail_id) {
            modalAgregarReceta(event,recipe_id,plan_detail_id);
        }

        function deleteRecipeByDay(event,plan_detail_id) {
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

                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      '{{ route('admin.plan.deleteDetailByDay') }}',
                        type:     'DELETE',
                        data:    {
                            'id':plan_detail_id,
                        },
                        success: function(data) {
                            var datos = data;
                            procesando.remove();
                            Lobibox.notify('success',{msg:datos.mensaje});
                            $(`#recipes-by-day-datatable-${datos.day}`).DataTable().ajax.reload();
                            getTotalesPorDia(datos.day);
                            getRecipes();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            procesando.remove();
                            Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                        }
                    });
                }
            });
        }

        function getTotalCompletoPlanPorDia(e,plan_id,day) {
            e.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

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
                    procesando.remove();
                    Swal.fire({
                        title: '<strong>Composición Por Día</strong>',
                        html: datos,
                        showConfirmButton: false,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        // confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
                        // confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '',
                        cancelButtonAriaLabel: 'Thumbs down'
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function storeOrder(e,day){
            e.preventDefault();
            var orders = $(`input[id^="order_${day}"]`);

            if(orders.length === 0){
                return Lobibox.notify('error',{msg: 'Agregue recetas al día para continuar'});
            }

            var values = [];
            var empty_values = false;

            $.each(orders,function (i,input){
                let split_id        = input.id.split('_');
                let plan_detail_id  = split_id[2];
                let order_type      = $(`#order-type_${day}_${plan_detail_id}`).val();

                if(input.value === "" || input.value === 0 || order_type === "" || order_type === 0){
                    empty_values = true;
                    return false;
                }

                values.push({
                   'id': split_id[2],
                   'order': input.value,
                   'order_type' : order_type,
                });
            });

            if(empty_values){
                return Lobibox.notify('error',{msg: 'Para guardar el orden debe ingresar todos los valores'});
            }

            if(values.length === 0){
                return Lobibox.notify('error',{msg: 'Ingrese los valores para ordenar las recetas'});
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.storeOrderPlanDetailDay') }}',
                type:     'POST',
                data:    {
                    'values':values,
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

        function closePlan(event){
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

                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      '{{ route('admin.plan.closePlan',$plan->id) }}',
                        type:     'POST',
                        data: {},
                        success: function(data) {
                            var datos = data;
                            procesando.remove();
                            Lobibox.notify('success',{msg:datos.mensaje});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            procesando.remove();
                            if(xhr.status === 422){
                                Lobibox.notify('error',{msg: xhr.responseJSON.error});
                            }else{
                                Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                            }
                        }
                    });
                }
            });
        }

        function openPlan(event) {
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

                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      '{{ route('admin.plan.openPlan',$plan->id) }}',
                        type:     'POST',
                        data: {},
                        success: function(data) {
                            var datos = data;
                            procesando.remove();
                            Lobibox.notify('success',{msg:datos.mensaje});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            procesando.remove();
                            if(xhr.status === 422)
                                return Lobibox.notify('error',{msg: xhr.responseJSON.error });

                            Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                        }
                    });
                }
            });
        }

        function updateNameRecipe(event)
        {
            event.preventDefault();
            var new_name = $("#new_name").val();
            var recipe_id = $("#hidden_recipe_id").val();

            if(new_name === null || new_name === undefined || new_name === ""){
                return Lobibox.notify('error',{msg:'Ingrese el nuevo nombre'});
            }

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.updateRecipeName') }}',
                type:     'POST',
                data: {
                    'new_name': new_name,
                    'recipe_id': recipe_id
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{msg:datos.mensaje});
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422)
                        return Lobibox.notify('error',{msg: xhr.responseJSON.error });

                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });

        }

        function showObservations(event,plan_detail_id)
        {
            event.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.modalObservations') }}',
                type:     'GET',
                data: {
                    'plan_detail_id': plan_detail_id,
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    $("#modalRecipe").empty().html(datos);

                    $("#observations").select2({
                        width: '100%',
                    });

                    $("#modalRecipe").modal('show');
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422)
                        return Lobibox.notify('error',{msg: xhr.responseJSON.error });

                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function addObservation(event)
        {
            event.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            var observations    = $("#observations").val();
            var plan_detail_id  = $("#hidden_plan_detail_id").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.addObservation') }}',
                type:     'POST',
                data: {
                    'plan_detail_id': plan_detail_id,
                    'observations':observations
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{msg: datos.mensaje });
                    $(`#recipes-by-day-datatable-${datos.day}`).DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422)
                        return Lobibox.notify('error',{msg: xhr.responseJSON.error });

                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function addNewObservation(event,plan_detail_id)
        {
            event.preventDefault();

            var name = $("#observation").val();

            if(name.trim() === "")
                return Lobibox.notify('error',{msg: 'Ingrese el nombre de la observación'});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.addNewObservation') }}',
                type:     'POST',
                data: {
                    'plan_detail_id': plan_detail_id,
                    'name': name
                },

                success: function(data) {
                    var datos = data;

                    $("#observation").val("");

                    var new_observation = new Option(data.observation.name, data.observation.id, false, false);
                    $('#observations').append(new_observation);
                    var observations = $('#observations').val();
                    observations.push(data.observation.id);
                    $("#observations").val(observations).trigger('change');
                },
                error: function(xhr, textStatus, errorThrown) {
                    if(xhr.status === 422)
                        return Lobibox.notify('error',{msg: xhr.responseJSON.error });

                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush


