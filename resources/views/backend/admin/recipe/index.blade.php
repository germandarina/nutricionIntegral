@extends('backend.layouts.app')

@section('title', app_name() . ' | Administración de Recetas')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Administración de Recetas <small class="text-muted">Recetas Activas</small>
                </h5>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.admin.recipe.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Clasificación</th>
                            <th class="not-export-col">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
@section('modal-yield')
    <div class="modal fade" id="modalCopyRecipe" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Copiar Receta</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="bodyIngredients">
                    <input type="hidden" id="url_food">
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="">Nombre Anterior</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled id="old_name">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-2">
                            <label for="">Nuevo Nombre</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="new_name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button id="btnGuardar" class="btn btn-primary" type="button" onclick="copyRecipe(event)">Guardar</button>
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
                    {data: 'recipeType', name: 'recipeType'},
                    {data: 'classifications', name: 'classifications'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });

        function modalCopyRecipe(event,element){
            event.preventDefault();
            var name =  element.data('name');
            var url  =  element.data('url');
            $("#old_name").val(name);
            $("#url_food").val(url);
            $("#modalCopyRecipe").modal('show');
        }

        function copyRecipe(event){
            event.preventDefault();
            var url =  $("#url_food").val();
            var name = $("#new_name").val();

            if(name === ""){
                $("#new_name").addClass('is-invalid');
                return Lobibox.notify('error',{msg: 'Ingrese el nombre por favor'});
            }

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  url,
                type: 'POST',
                data: {
                    'name': name,
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{msg:datos.mensaje});
                    $('.data-table').DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush

