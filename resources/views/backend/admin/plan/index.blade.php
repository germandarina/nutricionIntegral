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
            <input type="hidden" id="open" value="1">
            <input type="hidden" id="duplicate" value="0">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table font-xs">
                        <thead>
                        <tr>
                            <th style="border-top: none; background: black;">
                                <div class="col-lg-12 col-xs-12">
                                    <a href="#" onclick="filterClose(event)" class="btn btn-sm btn-square btn-dark btn-block"><span style="color:#60bd75;"><i class="fas fa-lock" style="color:#60bd75;"></i> <strong>Cerrados</strong></span></a>
                                </div>
                            </th>
                            <th style="border-top: none; background: black;">
                                <div class="row">
                                    <div class="col-lg-6 col-xs-6">
                                        <a href="#" onclick="filterOpen(event)" class="btn btn-sm btn-square btn-dark btn-block"><span style="color:#FFFFFF;"><i class="fas fa-unlock-alt" style="color:#FFFFFF;"></i> <strong>Abiertos</strong></span></a>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <a href="#" onclick="filterDuplicate(event)" class="btn btn-sm btn-square btn-dark btn-block"><span style="color:#fdde08;"><i class="fas fa-unlock-alt" style="color:#fdde08;"></i> <strong>Duplicados Abiertos</strong></span></a>
                                    </div>
                                </div>
                            </th>
                            <th colspan="4" style="text-align: center;background: black; color: white; border-top: none; border-left: 2px white solid;">Necesidades Diarias</th>
                        </tr>
                        <tr>
                            <th>Paciente</th>
                            <th>Plan</th>
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

    .planning-duplicate-open{
        background-color: #fdde087a;
    }
</style>
@push('after-scripts')
    @include('datatables.includes')
    <script>
        var datatable = $('.data-table');

        $(function () {
            datatable.DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                "orderable": false,
                createdRow: function( row, data, dataIndex){
                    if(data.open ===  0){
                        $(row).addClass('planning-closed');
                    }

                    if(data.open ===  1 && data.origin_plan_id !== null){
                        $(row).addClass('planning-duplicate-open');
                    }
                },
                ajax:{
                    url: "{{ route('admin.plan.index') }}",
                    data: function (d) {
                        d.open = $('#open').val();
                        d.duplicate = $('#duplicate').val();
                    }
                },
                columns: [
                    {data: 'patient.full_name', name: 'patient.full_name'},
                    {data: 'name', name: 'name'},
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

        function filterClose(e)
        {
            e.preventDefault();
            $('#open').val(0);
            $('#duplicate').val(0);
            datatable.DataTable().ajax.reload();
        }

        function filterOpen(e)
        {
            e.preventDefault();
            $('#open').val(1);
            $('#duplicate').val(0);
            datatable.DataTable().ajax.reload();
        }

        function filterDuplicate(e)
        {
            e.preventDefault();
            $('#open').val(1);
            $('#duplicate').val(1);
            datatable.DataTable().ajax.reload();
        }
    </script>
@endpush

