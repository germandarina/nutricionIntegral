<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8 col-xs-12">
                <h5 class="card-title mb-0">
                    <small class="text-muted">PROGRESOS DEL PACIENTE</small>
                </h5>
            </div><!--col-->
        </div><!--row-->
        <hr>
        <div class="row">
            {!! $graphics->container() !!}
        </div>
    </div>
</div><!--card-->


@push('graphic-scripts')
    {{ script("chart/Chart.min.js") }}

    {!! $graphics->script() !!}
@endpush
