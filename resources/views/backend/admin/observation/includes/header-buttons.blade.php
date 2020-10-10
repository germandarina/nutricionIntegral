<div class="btn-group float-right ml-2" role="group" aria-label="Button group with nested dropdown">
    <a href="{{ route('admin.observation.create') }}" class="btn btn-success ml-2 btn-sm" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
    <div class="btn-group" role="group">
        <button class="btn btn-sm btn-success dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Observaciones</b></button>
        <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.observation.index') }}">Todos las Observaciones</a>
            <a class="dropdown-item" href="{{ route('admin.observation.deleted') }}">Observaciones Eliminadas</a>
        </div>
    </div>
</div>
