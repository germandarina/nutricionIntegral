@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Recetas')

@section('content')
{{ html()->modelForm($recipe, 'PATCH', route('admin.recipe.update', $recipe))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Recetas</small>
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
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    <a href="#" class="btn btn-success btn-sm">Agregar Ingredientes <icon class="fas fa-plus-circle"></icon></a>
                    <button class="btn btn-secondary mb-1" type="button" data-toggle="modal" data-target="#largeModal">Launch large modal</button>
                </h5>
            </div><!--col-->
        </div><!--row-->
        @include('backend.admin.recipe.partials.add-ingredients')
    </div>
</div>

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button">Save changes</button>
            </div>
        </div>

    </div>
</div>

@endsection
@push('after-scripts')
    {!! $validator !!} ssh
@endpush
