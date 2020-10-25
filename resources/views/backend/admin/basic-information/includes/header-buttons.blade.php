@if(is_null($basic_information))
    <div class="btn-group float-right ml-2" role="group" aria-label="Button group with nested dropdown">
        <a href="{{ route('admin.basic-information.create') }}" class="btn btn-success ml-2 btn-sm" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i> Cargar Datos</a>
    </div>
@endif
