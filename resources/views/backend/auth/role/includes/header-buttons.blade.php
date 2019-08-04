<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.auth.role.create') }}" class="btn btn-success ml-1 btn-sm" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
    <div class="btn-group" role="group">
        <button class="btn btn-sm btn-success dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.roles.main')</button>
        <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.role.index') }}">@lang('menus.backend.access.roles.all')</a>
            {{--            <a class="dropdown-item" href="{{ route('admin.auth.role.create') }}">@lang('menus.backend.access.roles.create')</a>--}}
{{--            <a class="dropdown-item" href="{{ route('admin.auth.role.deactivated') }}">@lang('menus.backend.access.roles.deactivated')</a>--}}
            <a class="dropdown-item" href="{{ route('admin.auth.role.deleted') }}">@lang('menus.backend.access.roles.deleted')</a>
        </div>
    </div>
</div>
