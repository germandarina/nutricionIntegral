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
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Alimentos</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel">
                                @include('backend.admin.patient.partials.form')
                            </div>
                            <div class="tab-pane" id="profile-1" role="tabpanel">
                                @include('backend.admin.patient.partials.food-form')
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
@push('after-scripts')
    {!! $validator !!}
@endpush
