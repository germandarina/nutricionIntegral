@extends('backend.layouts.app')

@section('title', app_name() . ' | Agregar Recetas')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- roww and table -->
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-responsive-sm table-sm">
                    <thead>
                        <tr style="background-color: #20a8d8; color: white; ">
                            <th style="text-align: center;">Paciente</th>
                            <th style="text-align: center;">Plan</th>
                            <th style="text-align: center;" >Cant Días</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;" ><strong>{{$paciente->full_name}}</strong></td>
                            <td style="text-align: center;"><strong>{{$plan->name}}</strong></td>
                            <td style="text-align: center;"><strong>{{$plan->days}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end row and table -->
        @include('backend.admin.plan.partials.tabs-recipes-days')
    </div><!--card-body-->
</div><!--card-->

@endsection

@push('after-scripts')
    @include('datatables.includes')
    <script>
        $(function () {
            {{--$('.data-table').DataTable({--}}
            {{--    "processing": true,--}}
            {{--    "serverSide": true,--}}
            {{--    "draw": true,--}}
            {{--    ajax: "{{ route('admin.plan.index') }}",--}}
            {{--    columns: [--}}
            {{--        {data: 'patient.full_name', name: 'patient.full_name'},--}}
            {{--        {data: 'name', name: 'name'},--}}
            {{--        {data: 'days', name: 'days'},--}}
            {{--        {data: 'actions', name: 'actions', orderable: false, searchable: false,},--}}
            {{--    ]--}}
            {{--});--}}
        });
    </script>
@endpush
<style>
    .select2-selection__choice{
     font-size: 11px;
    }
</style>

