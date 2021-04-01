@extends('backend.layouts.app')

@section('title', app_name() . ' | Administración de Información Personal')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Administración de Información Personal
                </h5>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.config.basic-information.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table font-xs">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Matricula</th>
                            <th>Empresa</th>
                            <th>Dirección</th>
                            <th>E-mail</th>
                            <th>Teléfonos</th>
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
                ajax: "{{ route('config.basic-information.index') }}",
                columns: [
                    {data: 'full_name', name: 'full_name'},
                    {data: 'm_professional', name: 'm_professional'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'address', name: 'address'},
                    {data: 'email', name: 'email'},
                    {data: 'phones', name: 'phones'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });
    </script>
@endpush

