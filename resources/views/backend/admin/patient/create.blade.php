@extends('backend.layouts.app')

@section('title', app_name() . ' | Crear Paciente')

@section('content')
{{ html()->form('POST', route('admin.patient.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Crear Paciente</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.admin.patient.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.patient.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
@push('after-scripts')
    {!! $validator !!}
    <script>
        $('#birthdate').datepicker({
            format: 'dd/mm/yyyy',
            language: 'es',
            endDate : '0d',
            autoclose: true,
            orientation: "bottom right"
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
    </script>
@endpush
