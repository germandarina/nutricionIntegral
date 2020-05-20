@extends('backend.layouts.app')

@section('title', app_name() . ' | Agregar Recetas')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- roww and table -->
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-responsive-sm table-sm font-xs">
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
<style>
    .select2-selection__choice{
     font-size: 11px;
    }
</style>

