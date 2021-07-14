@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Paciente')

@section('content')
    {{ html()->modelForm($patient, 'PATCH', route('admin.patient.update', $patient))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Paciente</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row">
                <div class="col-md-12 mb-12">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home">Datos Personales</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Clasificación y Alimentos</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-2" role="tab" aria-controls="profile">Controles</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel">
                                @include('backend.admin.patient.partials.form')
                            </div>
                            <div class="tab-pane" id="profile-1" role="tabpanel">
                                @include('backend.admin.patient.partials.food-form')
                            </div>

                            <div class="tab-pane" id="profile-2" role="tabpanel">
                                @include('backend.admin.patient.partials.patient_controls')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.patient.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection

@section('modal-yield')

    <div class="modal fade" id="modalControl" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulario de Control</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="bodyAffection">
                    <div style="padding: 1rem !important;">
                        @include('backend.admin.patient.partials.form_patient_control')
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button id="btnControl" class="btn btn-primary" type="button" onclick="addControl(event)">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    {!! $validator !!}
    @include('datatables.includes')

    {{ script("chart/Chart.min.js") }}

    {!! $chart->script() !!}

    <script>

        var original_api_url = {{ $chart->id }}_api_url;

        $('#birthdate').datepicker({
            format: 'dd/mm/yyyy',
            language: 'es',
            endDate : '0d',
            autoclose: true,
        });

        $('#period').datepicker({
            changeMonth: true,
            changeYear: true,
            viewMode: "months",
            minViewMode: "months",
            format: 'mm/yyyy',
            language: 'es',
            autoclose: true,
            maxViewMode: 1
        });

        $("input[type='text']").click(function () {
            $(this).select();
        });

        function getAge(){
            var birthdate = $("#birthdate").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  '{{ route('admin.patient.getAge') }}',
                type: 'POST',
                data: {
                    'birthdate': birthdate,
                },
                success: function(data) {
                    var datos = data;
                    $("#age").val(datos.age);
                },
                error: function(xhr, textStatus, errorThrown) {
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function modalControls(event)
        {
            event.preventDefault();
            limpiarModalControl();
            $("#modalControl").modal("show");
        }

        function limpiarModalControl()
        {
            $('#bodyAffection input[type="text"]').val('');
        }

        function addControl(event){
            event.preventDefault();
            var period = $('#period').val();
            var height = $('#height').val();
            var weight = $('#weight').val();
            var waist   = $('#waist').val();
            var hips   = $('#hips').val();
            var muscle_kg   = $('#muscle_kg').val();
            var fat_kg   = $('#fat_kg').val();
            var muscle_percent   = $('#muscle_percent').val();
            var fat_percent   = $('#fat_percent').val();

            if(period === null || period === "" || period === 0)
                return Lobibox.notify('error',{msg:'Debe ingresar una fecha'});

            if(height === '')
            {
                height = 0;
            }
            else {
                height = height.replace('.','');
                height = height.replace(',','.');
                height = parseFloat(height);
            }

            if(weight === '') {
                weight = 0;
            }else {
                weight = weight.replace('.','');
                weight = weight.replace(',','.');
                weight = parseFloat(weight);
            }

            if(waist === '') {
                waist = 0;
            }else{
                waist = waist.replace('.','');
                waist = waist.replace(',','.');
                waist = parseFloat(waist);
            }

            if(hips === '') {
                hips = 0;
            }
            else {
                hips = hips.replace('.','');
                hips = hips.replace(',','.');
                hips = parseFloat(hips);
            }

            if(muscle_kg === '') {
                muscle_kg = 0;
            }else
            {
                muscle_kg = muscle_kg.replace('.','');
                muscle_kg = muscle_kg.replace(',','.');
                muscle_kg = parseFloat(muscle_kg);
            }

            if(fat_kg === '') {
                fat_kg = 0;
            }else
            {
                fat_kg = fat_kg.replace('.','');
                fat_kg = fat_kg.replace(',','.');
                fat_kg = parseFloat(fat_kg);
            }

            if(muscle_percent === '') {
                muscle_percent = 0;
            }else
            {
                muscle_percent = muscle_percent.replace('.','');
                muscle_percent = muscle_percent.replace(',','.');
                muscle_percent = parseFloat(muscle_percent);
            }

            if(fat_percent === '') {
                fat_percent = 0;
            }else {
                fat_percent = fat_percent.replace('.','');
                fat_percent = fat_percent.replace(',','.');
                fat_percent = parseFloat(fat_percent);
            }

            if(!is_numeric(height))
                return Lobibox.notify('error',{msg:'Debe ingresar la talla'});

            if(!is_numeric(weight))
                return Lobibox.notify('error',{msg:'Debe ingresar el peso'});

            if(!is_numeric(waist))
                return Lobibox.notify('error',{msg:'Debe ingresar el valor de la cintura'});

            if(!is_numeric(hips))
                return Lobibox.notify('error',{msg:'Debe ingresar el valor de la cadera'});

            if(!is_numeric(muscle_kg))
                return Lobibox.notify('error',{msg:'Debe ingresar los kg de músculos'});

            if(!is_numeric(fat_kg))
                return Lobibox.notify('error',{msg:'Debe ingresar los kg de grasa'});

            if(!is_numeric(muscle_percent))
                return Lobibox.notify('error',{msg:'Debe ingresar el porcentaje de músculos'});

            if(!is_numeric(fat_percent))
                return Lobibox.notify('error',{msg:'Debe ingresar el porcentaje de grasa'});

            $("#btnControl").attr('disabled',true);

            var control_id = $('#control_id').val();

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  '{{ route('admin.patient.storeControl',$patient->id) }}',
                type: 'POST',
                data: {
                    period :period,
                    height : height,
                    weight : weight,
                    waist : waist,
                    hips : hips,
                    muscle_kg : muscle_kg,
                    fat_kg : fat_kg,
                    muscle_percent :muscle_percent,
                    fat_percent: fat_percent,
                    id: control_id
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{msg:datos.mensaje});
                    $('#table-controls').DataTable().ajax.reload();
                    {{ $chart->id }}_refresh(original_api_url);
                    $('#modalControl').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    procesando.remove();
                    if (jqXHR.status === 422){
                        let mensaje = jqXHR.responseJSON.error
                        Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                    }
                    else
                    {
                        Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                    }
                },
                complete: function (){
                    $("#btnControl").attr('disabled',false);
                }
            });
        }

        function modalEditControl(event,id)
        {
            event.preventDefault();
            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  '{{ route('admin.patient.getControl') }}',
                type: 'POST',
                data: {
                    id :id,
                },
                success: function(data) {
                    var datos = data.control;
                    procesando.remove();

                    $('#period').val(data.period);
                    $('#height').val(datos.height);
                    $('#weight').val(datos.weight);
                    $('#waist').val(datos.waist);
                    $('#hips').val(datos.hips);
                    $('#muscle_kg').val(datos.muscle_kg);
                    $('#fat_kg').val(datos.fat_kg);
                    $('#muscle_percent').val(datos.muscle_percent);
                    $('#fat_percent').val(datos.fat_percent);
                    $('#control_id').val(id);

                    $('#modalControl').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    procesando.remove();
                    if (jqXHR.status === 422){
                        let mensaje = jqXHR.responseJSON.error
                        Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                    }
                    else
                    {
                        Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                    }
                },
                complete: function (){
                    $("#btnControl").attr('disabled',false);
                }
            });
        }

        function destroyControl(event,id)
        {
            event.preventDefault();
            Swal.fire({
                title: 'Está seguro de realizar ésta acción?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText : 'No',
            }).then((result) => {
                if (result.value) {
                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:  '{{ route('admin.patient.destroyControl') }}',
                        type: 'POST',
                        data: {
                            'id':id
                        },
                        success: (function (data){
                            procesando.remove();
                            Lobibox.notify("success",{msg: data.mensaje,'position': 'top right','title':'Éxito'});
                        }),
                        error: (function (jqXHR, exception) {
                            procesando.remove();
                            if (jqXHR.status === 422){
                                let mensaje = jqXHR.responseJSON.error
                                Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                            }
                        }),
                        complete:(function (data) {
                            $('#confirm').modal('hide');
                            $('.data-table').DataTable().draw(false);
                            {{ $chart->id }}_refresh(original_api_url);
                        })
                    });
                }
            });
        }

        $(function () {

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('#table-controls').DataTable({
                dom: 'Brtp',
                fixedHeader: true,
                paging:false,
                "scrollY": "250px",
                "scrollCollapse": true,
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons":[],
                "ordering": false,
                ajax: {
                    url : "{{ route('admin.patient.controls',$patient->id) }}",
                },
                fnInitComplete: function (oSettings, json) {
                    setTimeout(function (){
                        $('#{{ $chart->id }}').css("height", 400);
                    },1000);
                },
                columns: [
                    {data: 'period', name: 'period'},
                    {data: 'height', name: 'height'},
                    {data: 'weight', name: 'weight'},
                    {data: 'waist', name: 'waist'},
                    {data: 'hips', name: 'hips'},
                    {data: 'muscle_kg', name: 'muscle_kg'},
                    {data: 'fat_kg', name: 'fat_kg'},
                    {data: 'muscle_percent', name: 'muscle_percent'},
                    {data: 'fat_percent', name: 'fat_percent'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });

        });
    </script>
@endpush
