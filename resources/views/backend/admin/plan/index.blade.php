@extends('backend.layouts.app')

@section('title', app_name() . ' | Administración de Planes')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Administración de Planes <small class="text-muted">Planes Activos</small>
                </h5>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.admin.plan.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table font-xs">
                        <thead>
                        <tr >
                            <th colspan="3" style="border-top: none;"></th>
                            <th colspan="4" style="text-align: center;background: black; color: white; border-top: none;">Necesidades Diarias</th>
                        </tr>
                        <tr>
                            <th>Paciente</th>
                            <th>Plan</th>
                            <th>Estado</th>
                            <th>Energia (kcal)</th>
                            <th>Proteina (g)</th>
                            <th>Carbohidratos (g)</th>
                            <th>Grasa (g)</th>
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
                "orderable": false,
                ajax: "{{ route('admin.plan.index') }}",
                columns: [
                    {data: 'patient.full_name', name: 'patient.full_name'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'energia_kcal_por_dia', name: 'energia_kcal_por_dia'},
                    {data: 'proteina_por_dia', name: 'proteina_por_dia'},
                    {data: 'carbohidratos_por_dia', name: 'carbohidratos_por_dia'},
                    {data: 'grasa_total_por_dia', name: 'grasa_total_por_dia'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });
    </script>
@endpush

