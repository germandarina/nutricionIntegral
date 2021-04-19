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
                        <tr>
                            <th colspan="2" style="border-top: none;">
                                <div class="col-lg-12 col-xs-12">
                                    <span style="color:#60bd75;"><i class="fas fa-lock fa-2x" style="color:#60bd75;"></i> <strong>Planes Cerrados</strong></span>
                                </div>
                            </th>
                            <th colspan="4" style="text-align: center;background: black; color: white; border-top: none;">Necesidades Diarias</th>
                        </tr>
                        <tr>
                            <th>Paciente</th>
                            <th>Plan</th>
{{--                            <th>Estado</th>--}}
                            <th>Energia (kcal)</th>
                            <th>Proteina (g)</th>
                            <th>Carbohidratos (g)</th>
                            <th>Grasa (g)</th>
                            <th class="not-export-col" style="width: 5%;">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
<style>
    .planning-closed{
        background-color: #60bd7596;
    }
</style>
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
                createdRow: function( row, data, dataIndex){
                    if(data.open ===  0){
                        $(row).addClass('planning-closed');
                    }
                },
                ajax: "{{ route('admin.plan.index') }}",
                columns: [
                    {data: 'patient.full_name', name: 'patient.full_name'},
                    {data: 'name', name: 'name'},
                    // {data: 'status', name: 'status'},
                    {data: 'energia_kcal_por_dia', name: 'energia_kcal_por_dia'},
                    {data: 'proteina_por_dia', name: 'proteina_por_dia'},
                    {data: 'carbohidratos_por_dia', name: 'carbohidratos_por_dia'},
                    {data: 'grasa_total_por_dia', name: 'grasa_total_por_dia'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
        });

        function duplicatePlanning(event,plan_id)
        {
            event.preventDefault();
            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
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
                        url:  "{{ route('admin.plan.copyPlanning') }}",
                        type: 'POST',
                        data: {
                            'plan_id' : plan_id,
                        },
                        success: (function (data){
                            procesando.remove();
                            Lobibox.notify('success',{msg:data.mensaje});
                            $(".data-table").DataTable().ajax.reload();
                        }),
                        error: (function (jqXHR, exception) {
                            procesando.remove();
                            if (jqXHR.status === 422){
                                let mensaje = jqXHR.responseJSON.error
                                Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                            }
                        })
                    });
                }
            });
        }
    </script>
@endpush

