@extends('backend.layouts.app')

@section('title', app_name() . ' | Crear Receta')

@section('content')
{{ html()->form('POST', route('admin.recipe.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Crear Receta</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.admin.recipe.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.recipe.index'), __('buttons.general.cancel')) }}
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
@endpush
