@extends('backend.layouts.app')

@section('title', app_name() . ' | Administración de Recetas')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Administración de Recetas Editadas en Planes <small class="text-muted">Recetas Editadas en Planes</small>
                </h5>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table font-xs">
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
    <div class="modal fade" id="modalRecipe" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>
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
                "initComplete": function(){
                    $(".data-table").find("[rel=tooltip]").tooltip();
                },
                ajax: "{{ route('admin.recipe.indexEdit') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'recipeType', name: 'recipeType'},
                    {data: 'classifications', name: 'classifications'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });

        function viewRecipe(event,recipe_id)
        {
            event.preventDefault();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  '{{ route('admin.recipe.viewRecipe') }}',
                type: 'POST',
                data: {
                    'recipe_id': recipe_id,
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    $("#modalRecipe").empty().html(datos);
                    $("#modalRecipe").modal('show');
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function updateRecipe(event,recipe_id)
        {
            event.preventDefault();

            Swal.fire({
                title: 'Está seguro de realizar ésta acción?',
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
                        url: '{{ route('admin.recipe.updateRecipe') }}',
                        type:'POST',
                        data:{
                            'recipe_id':recipe_id,
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

    </script>
@endpush

