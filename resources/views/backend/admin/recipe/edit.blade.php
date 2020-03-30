@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Recetas')

@section('content')
{{ html()->modelForm($recipe, 'PATCH', route('admin.recipe.update', $recipe))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
{{--            <div class="row">--}}
{{--                <div class="col-sm-5">--}}
{{--                    <h5 class="card-title mb-0">--}}
{{--                        <small class="text-muted">Actualizar Recetas</small>--}}
{{--                    </h5>--}}
{{--                </div><!--col-->--}}
{{--            </div><!--row-->--}}
{{--            <hr>--}}
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
                    <button class="btn btn-success btn-sm" type="button" onclick="modalIngredientes(event)" >Agregar Ingredientes <icon class="fas fa-plus-circle"></icon></button>
                </h5>
            </div><!--col-->
        </div><!--row-->
        @include('backend.admin.recipe.partials.datatable-ingredients')
    </div>
</div>
@endsection
@section('modal-yield')
    <div class="modal fade" id="modalIngredientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                    <button class="btn btn-primary" type="button">Agregar</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after-scripts')
    @include('datatables.includes')
    <script>
        $(function () {
            $('.data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                'paging':false,
                "info":     false,
                "buttons": [],
                ajax: "{{ route('admin.recipe.getIngredients',$recipe->id) }}",
                columns: [
                    {data: 'food.name', name: 'food.name'},
                    {data: 'quantity_description', name: 'quantity_description'},
                    {data: 'quantity_grs', name: 'quantity_grs'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });

            $('#food_id').select2({
                placeholder: "Buscar alimentos...",
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('admin.recipe.searchIngredients') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term),
                            food_group_id: $("#food_group_id").val(),
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
            $("#food_group_id").select2("val",0);
            $("#food_id").select2("val",0);
            $("#quantity_description").val("");
            $("#quantity_grs").val("");
            $("#divComposicion").empty();
        }

        function modalIngredientes(event) {
            event.preventDefault();
            limpiarModal();
            $("#modalIngredientes").modal("show");
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
                        //alert('AJAX ERROR ! Check the console !');
                        //console.error(errorThrown);
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

        function modificarComposicion(event,ingrediente_id) {
            event.preventDefault();
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
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });

        }
        function eliminarComposicion(event,ingrediente_id) {
            event.preventDefault();
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
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
    {!! $validator !!}
@endpush
