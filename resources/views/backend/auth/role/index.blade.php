@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.roles.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    @lang('labels.backend.access.roles.management') <small class="text-muted">{{ __('labels.backend.access.roles.active') }}</small>
                </h5>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.role.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.roles.table.role')</th>
                            <th>@lang('labels.backend.access.roles.table.permissions')</th>
                            <th>@lang('labels.backend.access.roles.table.number_of_users')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
{{--                        <tbody>--}}
{{--                        @foreach($roles as $role)--}}
{{--                            <tr>--}}
{{--                                <td>{{ ucwords($role->name) }}</td>--}}
{{--                                <td>--}}
{{--                                    @if($role->id == 1)--}}
{{--                                        @lang('labels.general.all')--}}
{{--                                    @else--}}
{{--                                        @if($role->permissions->count())--}}
{{--                                            @foreach($role->permissions as $permission)--}}
{{--                                                {{ ucwords($permission->name) }}--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            @lang('labels.general.none')--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{ $role->users->count() }}</td>--}}
{{--                                <td>{!! $role->action_buttons !!}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
{{--        <div class="row">--}}
{{--            <div class="col-7">--}}
{{--                <div class="float-left">--}}
{{--                    {!! $roles->total() !!} {{ trans_choice('labels.backend.access.roles.table.total', $roles->total()) }}--}}
{{--                </div>--}}
{{--            </div><!--col-->--}}

{{--            <div class="col-5">--}}
{{--                <div class="float-right">--}}
{{--                    {!! $roles->render() !!}--}}
{{--                </div>--}}
{{--            </div><!--col-->--}}
{{--        </div><!--row-->--}}
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
    @include('datatables.includes')
    <script>
        $(function () {
            $('.data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                ajax: "{{ route('admin.auth.role.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'permissions', name: 'permissions'},
                    {data: 'numbers_of_users', name: 'numbers_of_users'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush

