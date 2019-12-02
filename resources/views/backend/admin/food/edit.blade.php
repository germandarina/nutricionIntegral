@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Grupo de Alimentos')

@section('content')
{{ html()->modelForm($food_group, 'PATCH', route('admin.food-group.update', $food_group))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Grupo de Alimentos</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.admin.food-group.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.food-group.index'), __('buttons.general.cancel')) }}
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
