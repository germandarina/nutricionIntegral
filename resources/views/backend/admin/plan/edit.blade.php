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
            @include('backend.admin.plan.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.plan.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
    {!! $validator !!}

    <script>
        $(function () {
            $('#patient_id').select2({
                placeholder: "Buscar paciente...",
                minimumInputLength: 2,
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
        });
    </script>
@endpush
