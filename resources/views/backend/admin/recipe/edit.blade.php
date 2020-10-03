@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Recetas')

@section('content')
{{ html()->modelForm($recipe, 'PATCH', route('admin.recipe.update', $recipe))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            @include('backend.admin.recipe.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.recipe.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <button class="btn btn-success btn-sm" type="button" onclick="modalIngredientes(event)" >Agregar Ingredientes <i class="fas fa-plus-circle"></i></button>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            @include('backend.admin.recipe.partials.datatable-ingredients')
            <div class="row mt-lg-2" id="divTotales">

            </div>
        </div>
    </div>

@endsection

@section('modal-yield')
    <div class="modal fade" id="modalIngredientes" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Ingrediente</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="bodyIngredients">
                    @include('backend.admin.recipe.partials.add-ingredients')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button id="btnGuardar" class="btn btn-primary" type="button" onclick="agregarIngrediente(event)">Agregar</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after-scripts')
    @include('datatables.includes')
    <script>
        var procesando = null;

        $(function () {
            $('#table-ingredients').DataTable({
                "processing":   true,
                "serverSide":   true,
                "draw":         true,
                'paging':       false,
                "info":         false,
                "orderable"  : false,
                "buttons": [],
                ajax: {
                    url: "{{ route('admin.recipe.getIngredients',$recipe->id) }}",
                    data: function ( d ) {
                        d.recipe_id = "{{$recipe->id}}";
                    },
                },
                columns: [
                    {data: 'food.name', name: 'food.name',width:'40%',orderable:false},
                    {data: 'quantity_description', name: 'quantity_description',width:'30%',orderable:false},
                    {data: 'quantity_grs', name: 'quantity_grs',width:'20%',orderable:false},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,width:'10%'},
                ],
                "footerCallback": function( tfoot, data, start, end, display ) {
                    mostrarTotales();
                }
            });

            $('#food_id').select2({
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

        });

        function limpiarModal() {
            $("#food_id").select2("val",0);
            $("#quantity_description").val("");
            $("#quantity_grs").val("");
            $("#ingredient_id").val("");
            $("#divComposicion").empty();
            $("#divCalculate").empty();
        }

        function limpiarCantidades(){
            $("#quantity_description").val("");
            $("#quantity_grs").val("");
            $('#divCalculate').empty();
        }

        function modalIngredientes(event) {
            event.preventDefault();
            limpiarModal();
            $(".modal-title").empty().html("Agregar Ingredientes");
            $("#btnGuardar").empty().html("Agregar");
            $("#modalIngredientes").modal("show");
        }

        function getComposicionBasica() {
            var food_id = $("#food_id").val();

            if(food_id !== "" && food_id !== null && food_id !== undefined){
                procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:  '{{ route('admin.food.getComposicion') }}',
                    type: 'POST',
                    data: {
                        'food_id':food_id,
                    },
                    success: function(data) {
                        procesando.remove();
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
                url:  '{{ route('admin.food.getComposicionCompleta') }}',
                type: 'POST',
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
                        //confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
                        //confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '',
                        //cancelButtonAriaLabel: 'Thumbs down'
                    })
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function agregarIngrediente(event) {

            event.preventDefault();
            var food_id = $("#food_id").val();
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
                    'recipe_id': "{{$recipe->id}}",
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{msg: datos.mensaje});
                    limpiarModal();
                    if(datos.edit){
                       $("#modalIngredientes").modal("hide");
                    }
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

        function modificarIngrediente(event,ingrediente_id) {
            event.preventDefault();
            $(".modal-title").empty().html("Editar Ingredientes");
            $("#btnGuardar").empty().html("Editar");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.recipe.getIngredient') }}',
                type:     'POST',
                data:    {
                    'ingredient_id':ingrediente_id,
                },
                success: function(data) {
                    var datos = data;
                    $("#food_group_id").select2("val",0);
                    var $newOption = $("<option selected='selected'></option>").val(datos.ingredient.food_id).text(datos.food.name);
                    $("#food_id").append($newOption).trigger('change');
                    $("#quantity_description").val(datos.ingredient.quantity_description);
                    $("#quantity_grs").val(datos.ingredient.quantity_grs);
                    $("#ingredient_id").val(datos.ingredient.id);
                    calculateGrs();
                    $("#modalIngredientes").modal("show");
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

        function eliminarIngrediente(event,ingrediente_id) {
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

                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      '{{ route('admin.recipe.deleteIngredient') }}',
                        type:     'DELETE',
                        data:    {
                            'ingredient_id':ingrediente_id,
                        },
                        success: function(data) {
                            var datos = data;
                            procesando.remove();
                            Lobibox.notify('success',{msg:datos.mensaje});
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
                    'recipe_id': "{{ $recipe->id }}",
                },
                success: function(data) {
                    $('#divTotales').empty().html(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function getTotalCompleto(event,recipe_id) {
            event.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.recipe.getTotalCompleto') }}',
                type:     'POST',
                data:    {
                    'recipe_id':recipe_id,
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Swal.fire({
                        title: '<strong>Total Composicion Receta</strong>',
                        icon: 'info',
                        html: datos,
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        //confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
                        //confirmButtonAriaLabel: 'Thumbs up, great!',
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

        function calculateGrs(){
            var food_id  = $("#food_id").val();
            var quantity = $("#quantity_grs").val();
            procesando.remove();
            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:   '{{ route('admin.recipe.calculateGrs') }}',
                type:  'POST',
                data:   {
                    'food_id': food_id,
                    'quantity': quantity
                },
                success: function(data) {
                    procesando.remove();
                    $('#divCalculate').empty().html(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>

    {!! $validator !!}
@endpush
