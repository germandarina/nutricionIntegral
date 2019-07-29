
<div class="btn-group float-right ml-2" role="group" aria-label="Button group with nested dropdown">
{{--    <button class="btn btn btn-success btn-sm" type="button">--}}
        <a href="{{ route('admin.auth.user.create') }}" class="btn btn-success ml-2 btn-sm" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
{{--    </button>--}}
    <div class="btn-group" role="group">
        <button class="btn btn-sm btn-success dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.users.main')</button>
        <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.auth.user.index') }}">@lang('menus.backend.access.users.all')</a>
{{--            <a class="dropdown-item" href="{{ route('admin.auth.user.create') }}">@lang('menus.backend.access.users.create')</a>--}}
            <a class="dropdown-item" href="{{ route('admin.auth.user.deactivated') }}">@lang('menus.backend.access.users.deactivated')</a>
            <a class="dropdown-item" href="{{ route('admin.auth.user.deleted') }}">@lang('menus.backend.access.users.deleted')</a>
        </div>
    </div>
</div>
