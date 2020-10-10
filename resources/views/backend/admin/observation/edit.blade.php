@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Observación')

@section('content')
{{ html()->modelForm($observation, 'PATCH', route('admin.observation.update', $observation))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Observación</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.admin.observation.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.observation.index'), __('buttons.general.cancel')) }}
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
@endpush
