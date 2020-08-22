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
                    <table class="table data-table">
                        <thead>
                        <tr >
                            <th colspan="3"></th>
                            <th colspan="4" style="text-align: center;background: #4dbd74; color: white;">Necesidades Diarias</th>
                        </tr>
                        <tr>
                            <th>Paciente</th>
                            <th>Nombre Plan</th>
                            <th>Cant. Días</th>
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
                ajax: "{{ route('admin.plan.index') }}",
                columns: [
                    {data: 'patient.full_name', name: 'patient.full_name'},
                    {data: 'name', name: 'name'},
                    {data: 'days', name: 'days'},
                    {data: 'energia_kcal_por_dia', name: 'energia_kcal_por_dia'},
                    {data: 'proteina_por_dia', name: 'proteina_por_dia'},
                    {data: 'carbohidratos_por_dia', name: 'carbohidratos_por_dia'},
                    {data: 'grasa_total_por_dia', name: 'grasa_total_por_dia'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });

        function getTotalComposicionForPlan(event,plan_id) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.plan.getTotalComposionPorPlan') }}',
                type:     'POST',
                data:    {
                    'id':plan_id,
                },
                success: function(data) {
                    var datos = data;
                    Swal.fire({
                        title: '<strong>Total Composición</strong>',
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
    </script>
@endpush

