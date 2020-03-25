@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Recetas')

@section('content')
{{ html()->modelForm($recipe, 'PATCH', route('admin.recipe.update', $recipe))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Recetas</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
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
                    <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#largeModal">Agregar Ingredientes <icon class="fas fa-plus-circle"></icon></button>
                </h5>
            </div><!--col-->
        </div><!--row-->
        @include('backend.admin.recipe.partials.datatable-ingredients')
    </div>
</div>
@endsection
@section('modal-yield')
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                "buttons": [],
                ajax: "{{ route('admin.recipe.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
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
                            q: $.trim(params.term)
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


    </script>
    {!! $validator !!}
@endpush
