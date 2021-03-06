@extends('backend.layouts.app')

@section('title', app_name() . ' | Administración de Grupo de Alimentos')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Administración de Grupo de Alimentos <small class="text-muted">Grupo de Grupo de Alimentos Activos</small>
                </h5>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.config.food-group.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table font-xs">
                        <thead>
                        <tr>
                            <th>Nombre</th>
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

@push('after-scripts')
    @include('datatables.includes')
    <script>
        $(function () {
            $('.data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                ajax: "{{ route('config.food-group.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });
    </script>
@endpush

