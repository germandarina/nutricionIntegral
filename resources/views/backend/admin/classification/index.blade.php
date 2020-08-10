@extends('backend.layouts.app')

@section('title', app_name() . ' | Administración de Clasificaciones')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Administración de Clasificaciones <small class="text-muted">Clasificaciones Activas</small>
                </h5>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.admin.classification.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table display compact">
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
            $('.compact').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                ajax: "{{ route('admin.classification.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });
    </script>
@endpush

