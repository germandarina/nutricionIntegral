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

    <script>
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
        });

        function useActivity(event)
        {
            var method = $("#method").val();
            switch (method)
            {
             case "1":
                 $("#divActivity").hide();
                 $(".label-result").empty().html('Cálculo de MB');
                 $("#divFaoOms").show();
                 break;

             case "2":
                 $("#divFaoOms").hide();
                 $("#divActivity").show();
                 $(".label-result").empty().html('Calorías Diarias Necesarias');
                 break;
             case "3":
                 $("#divFaoOms").hide();
                 $("#divActivity").hide();
                 $(".label-result").empty().html('Cálculo de TMB');
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

            if(method === "2")
            {
                activity = $("#activity").val();

                if(activity === null || activity === "")
                    return Lobibox.notify('error',{msg: 'Seleccione una actividad'});
            }

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
                    $("#method_result").val(data.result);
                    $("#divStoreSpendingEnergy").show();
                }),
                error: (function (jqXHR, exception) {
                    if (jqXHR.status === 422){
                        let mensaje = jqXHR.responseJSON.error
                        Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                    }
                    $("#divStoreSpendingEnergy").hide();
                }),
                complete:(function (data) {
                    // $('#confirm').modal('hide');
                    // $('.data-table').DataTable().draw(false);
                })
            });
        }

        function modalFao(event){
            event.preventDefault();
            var result = $("#method_result").val();

            if(result === null || result.trim() === "" || result === 0){
                return Lobibox.notify('error',{msg:'Antes de agregar una actividad, realice el calculo de TMB'});
            }
            result  = result.replace('.','');
            result  = result.replace(',','.');
            let tmb = result / 24;
            $("#tmb").val(tmb);

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

            var days            = $("#days").val();
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
        }
    </script>
@endpush
