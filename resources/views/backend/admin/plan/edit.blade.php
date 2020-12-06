@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Plan')

@section('content')
{{ html()->modelForm($plan, 'PATCH', route('admin.plan.update', $plan))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Plan</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row">
                <div class="col-md-12 mb-12">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home">Datos del Plan</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Cálculo Gasto Energético</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel">
                                @include('backend.admin.plan.partials.form')
                            </div>
                            <div class="tab-pane" id="profile-1" role="tabpanel">
                                @include('backend.admin.plan.partials.energy-spending')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.plan.index'), __('buttons.general.cancel')) }}
                </div><!--col-->
                @if($plan->open)
                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                @endif
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
@section('modal-yield')
    <div class="modal fade" id="modalFao" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Actividad</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="bodyIngredients">
                    @include('backend.admin.plan.partials.add-activities')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button id="btnGuardar" class="btn btn-primary" type="button" onclick="addFaoActivity(event)">Agregar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    {!! $validator !!}
    @include('datatables.includes')
    <script>
        var datatable_fao = null;

        $(function ()
        {
            $('#patient_id').select2({
                placeholder: "Buscar paciente...",
                minimumInputLength: 2,
                language: {
                    noResults: function () {
                        return "No hay resultados";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function(a){
                        return"Por favor ingrese "+(a.minimum-a.input.length)+" o más caracteres"
                    }
                },
                ajax: {
                    url: "{{ route('admin.patient.searchPatients') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term),
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            $("span.select2.select2-container.select2-container--default").css("width","100%");
            var $newOption = $("<option selected='selected'></option>").val({{$plan->patient->id}}).text("{{$plan->patient->full_name}}");
            $("#patient_id" ).append($newOption).trigger('change');

            useActivity(event);

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });

        function useActivity(event)
        {
            var method = $("#method").val();
            switch (method)
            {
             case "1":
                 if(datatable_fao === null)
                 {
                     datatable_fao = $('#table-activities-fao').DataTable({
                         dom: 'Brtp',
                         fixedHeader: true,
                         paging:false,
                         "processing": true,
                         "serverSide": true,
                         "draw": true,
                         "buttons": [],
                         "orderable": false,
                         ajax: "{{ route('admin.plan.getEnergySpending',$plan->id) }}",
                         columns: [
                             {data: 'description', name: 'description'},
                             {data: 'activity', name: 'activity'},
                             {data: 'factor_activity', name: 'factor_activity'},
                             {data: 'tmb', name: 'tmb'},
                             {data: 'hours', name: 'hours'},
                             {data: 'days', name: 'days'},
                             {data: 'weekly_average_activity', name: 'weekly_average_activity'},
                             {data: 'total', name: 'total'},
                             {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                         ]
                     });
                 }

                 $("#divActivity").hide();
                 $(".label-result").empty().html('Cálculo de MB');
                 $("#divFaoOms").show();
                 $("#divTMB").hide();

                 break;

             case "2":
             case "3":
                 $("#divFaoOms").hide();
                 $("#divActivity").show();
                 $(".label-result").empty().html('Calorías diarias necesarias');
                 $("#divTMB").show();
                 break;
            }
        }

        function calculate(event)
        {
            event.preventDefault();

            var method = $("#method").val();
            var weight = $("#weight").val();
            var height = $("#height").val();
            var age    = $("#age").val();
            var gender = $("#gender").val();
            var activity = null;

            if(method === null || method === "")
                return Lobibox.notify('error',{msg: 'Seleccione el método'});

            if(weight === null || weight === "")
                return Lobibox.notify('error',{msg: 'Ingrese el peso'});

            if(height === null || height === "")
                return Lobibox.notify('error',{msg: 'Ingrese la altura'});

            if(age === null || age === "")
                return Lobibox.notify('error',{msg: 'Ingrese la edad'});

            if(gender === null || gender === "")
                return Lobibox.notify('error',{msg: 'Seleccione el sexo / género'});

            if(method !== "1")
            {
                activity = $("#activity").val();

                if(activity === null || activity === "")
                    return Lobibox.notify('error',{msg: 'Seleccione una actividad'});
            }

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      "{{ route('admin.plan.calculateEnergySpending') }}",
                type:     'POST',
                data: {
                    'method': method,
                    'weight': weight,
                    'height': height,
                    'age': age,
                    'gender' :gender,
                    'activity':activity,
                },
                success: (function (data){
                    procesando.remove();
                    if(method === '1'){
                        $("#method_result").val(data.result);
                    }
                    else
                    {
                        $("#method_result").val(data.result.result);
                        $("#tmb_head").val(data.result.tmb);
                    }
                    $("#divStoreSpendingEnergy").show();
                }),
                error: (function (jqXHR, exception) {
                    procesando.remove();
                    if (jqXHR.status === 422){
                        let mensaje = jqXHR.responseJSON.error
                        Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                    }
                    $("#divStoreSpendingEnergy").hide();
                })
            });
        }

        function storeSpendingEnergy(event)
        {
            event.preventDefault();

            var method = $("#method").val();
            var weight = $("#weight").val();
            var height = $("#height").val();
            var age    = $("#age").val();
            var gender = $("#gender").val();
            var tmb_head    = null;
            var result = $("#method_result").val();
            var activity = null;

            if(method === null || method === "")
                return Lobibox.notify('error',{msg: 'Seleccione el método'});

            if(weight === null || weight === "")
                return Lobibox.notify('error',{msg: 'Ingrese el peso'});

            if(height === null || height === "")
                return Lobibox.notify('error',{msg: 'Ingrese la altura'});

            if(age === null || age === "")
                return Lobibox.notify('error',{msg: 'Ingrese la edad'});

            if(gender === null || gender === "")
                return Lobibox.notify('error',{msg: 'Seleccione el sexo / género'});

            if(method !== "1")
            {
                activity = $("#activity").val();

                if(activity === null || activity === "")
                    return Lobibox.notify('error',{msg: 'Seleccione una actividad'});

                tmb_head = $("#tmb_head").val();

                if(tmb_head === null || tmb_head === "")
                    return Lobibox.notify('error',{msg: 'Seleccione una actividad'});
            }

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      "{{ route('admin.plan.storeEnergySpending',$plan->id) }}",
                type:     'POST',
                data: {
                    'method': method,
                    'weight': weight,
                    'height': height,
                    'age': age,
                    'gender' : gender,
                    'activity': activity,
                    'tmb' : tmb_head,
                    'method_result': result
                },
                success: (function (data){
                    procesando.remove();
                    Lobibox.notify('success',{msg:data.mensaje});
                    $("#is_stored").val(1);
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

        function modalFao(event){
            event.preventDefault();
            var result = $("#method_result").val();
            var is_stored = $("#is_stored").val();

            if(result === null || result.trim() === "" || result === 0)
                return Lobibox.notify('error',{msg:'Antes de agregar una actividad, realice el calculo de MB'});


            if(is_stored === null || is_stored.trim() === "" || is_stored === 0)
                return Lobibox.notify('error',{msg:'Antes de agregar una actividad, guarde el calculo de MB'});


            result  = result.replace('.','');
            result  = result.replace(',','.');
            let tmb = result / 24;
            $("#tmb").val(tmb);

            limpiarModalFao();

            $("#modalFao").modal('show');
        }

        function setActivityValue(event)
        {
            event.preventDefault();
            var activity = $("#activity_fao").val();
            $("#factor_activity").val(activity);
        }

        function calculateAverageAndTotal(event)
        {
            event.preventDefault();
            var hour = $("#hours").val();
            hour     = hour.replace('.','');
            hour     = hour.replace(',','.');

            var days            = $("#days_activity").val();
            var total_by_day    = hour * days;
            var weekly_average  = total_by_day / 7;

            $("#weekly_average_activity").val(weekly_average);

            var tmb = $("#tmb").val();
            tmb     = tmb.replace('.','');
            tmb     = tmb.replace(',','.');

            var factor_activity = $("#factor_activity").val();
            factor_activity     = factor_activity.replace('.','');
            factor_activity     = factor_activity.replace(',','.');

            var total = weekly_average * tmb * factor_activity;

            $("#total").val(total);
        }

        function addFaoActivity(event)
        {
            event.preventDefault();

            var description     = $("#description").val();
            var activity_fao    = $("#activity_fao").val();
            var factor_activity = $("#factor_activity").val();
            var tmb             = $("#tmb").val();
            var hours           = $("#hours").val();
            var days_activity   = $("#days_activity").val();
            var weekly_average_activity = $("#weekly_average_activity").val();
            var total                   = $("#total").val();

            factor_activity = factor_activity.replace('.','');
            factor_activity = factor_activity.replace(',','.');
            factor_activity = parseFloat(factor_activity);

            tmb = tmb.replace('.','');
            tmb = tmb.replace(',','.');
            tmb = parseFloat(tmb);

            hours = hours.replace('.','');
            hours = hours.replace(',','.');
            hours = parseFloat(hours);

            weekly_average_activity = weekly_average_activity.replace('.','');
            weekly_average_activity = weekly_average_activity.replace(',','.');
            weekly_average_activity = parseFloat(weekly_average_activity);

            total = total.replace('.','');
            total = total.replace(',','.');
            total = parseFloat(total);

            if(description.trim() === '')
                return Lobibox.notify('error',{msg:'Ingrese la descripción'});

            if(activity_fao === "" || activity_fao === null)
                return Lobibox.notify('error',{msg:'Seleccione una actividad'});

            if(factor_activity === "" || factor_activity === null || factor_activity === 0 || factor_activity < 0 || isNaN(factor_activity))
                return Lobibox.notify('error',{msg:'Ingrese un valor correcto para el factor de actividad'});

            if(tmb === "" || tmb === null || tmb === 0 || tmb < 0 || isNaN(tmb))
                return Lobibox.notify('error',{msg:'Ingrese un valor correcto para el TMB'});

            if(hours === "" || hours === null || hours === 0 || hours < 0 || isNaN(hours))
                return Lobibox.notify('error',{msg:'Ingrese un valor correcto para la cantidad de horas'});

            if(days_activity === "" || days_activity === null || days_activity === 0 || days_activity < 0 || isNaN(days_activity))
                return Lobibox.notify('error',{msg:'Ingrese un valor correcto para los dias por semana'});

            if(weekly_average_activity === "" || weekly_average_activity === null || weekly_average_activity === 0 || weekly_average_activity < 0 || isNaN(weekly_average_activity))
                return Lobibox.notify('error',{msg:'Ingrese un valor correcto para el promedio de actividad'});

            if(total === "" || total === null || total === 0 || total < 0 || isNaN(total))
                return Lobibox.notify('error',{msg:'Ingrese un valor correcto para el total'});

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      "{{ route('admin.plan.storeActivityFao',$plan->id) }}",
                type:     'POST',
                data: {
                    'description' : description,
                    'activity' : activity_fao,
                    'factor_activity': factor_activity,
                    'tmb' : tmb,
                    'hours': hours,
                    'days' : days_activity,
                    'weekly_average_activity': weekly_average_activity,
                    'total': total
                },
                success: (function (data){
                    procesando.remove();
                    Lobibox.notify('success',{msg:data.mensaje});
                    limpiarModalFao();
                    $("#table-activities-fao").DataTable().ajax.reload();
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

        function limpiarModalFao()
        {
            $("#description").val("");
            $("#activity_fao").select2("val",0);
            $("#activity_fao").val(0).trigger('change');
            $("#factor_activity").val(0);
            $("#hours").val(0);
            $("#days_activity").val(0);
            $("#weekly_average_activity").val(0);
            $("#total").val(0);
        }

        function deleteEnergySpending(event,id)
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
                        url:  "{{ route('admin.plan.deleteActivityFao') }}",
                        type: 'DELETE',
                        data: {
                            'id' : id,
                        },
                        success: (function (data){
                            procesando.remove();
                            Lobibox.notify('success',{msg:data.mensaje});
                            $("#table-activities-fao").DataTable().ajax.reload();
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
