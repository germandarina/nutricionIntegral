@extends('backend.layouts.app')

@section('title', app_name() . ' | Crear Información Personal')

@section('content')
{{ html()->form('POST', route('config.basic-information.store'))->acceptsFiles()->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Cargar Información Personal</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.config.basic-information.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('config.basic-information.index'), __('buttons.general.cancel')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
@push('after-scripts')
    {!! $validator !!}
    <script>
        function showFrequencyDays()
        {
            var show = parseInt($("#show_frequency_days").val());
            if(show === 1)
            {
                $("#div_frenquency_days").show();
            }
            else
            {
                $("#div_frenquency_days").hide();
            }
        }
    </script>
@endpush
