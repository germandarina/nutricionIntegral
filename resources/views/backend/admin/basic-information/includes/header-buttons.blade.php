<div class="btn-group float-right ml-2" role="group" aria-label="Button group with nested dropdown">
    <a href="{{ route('admin.classification.create') }}" class="btn btn-success ml-2 btn-sm" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
    <div class="btn-group" role="group">
        <button class="btn btn-sm btn-success dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Clasificaciones</b></button>
        <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.classification.index') }}">Todos las Clasificaciones</a>
            <a class="dropdown-item" href="{{ route('admin.classification.deleted') }}">Clasificaciones Eliminadas</a>
        </div>
    </div>
</div>
