<div class="row">
    <div class="col-sm-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#add-recipes" role="tab" aria-controls="add-recipes"><strong>Agregar Recetas</strong></a></li>
                @for($i=1;$i<=$plan->days;$i++)
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day-{{$i}}" role="tab" aria-controls="day-{{$i}}">Día {{$i}}</a></li>
                @endfor
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="add-recipes" role="tabpanel">
                     @include('backend.admin.plan.partials.add-recipes')
                </div>
                @for($i=1;$i<=$plan->days;$i++)
                    <div class="tab-pane" id="day-{{$i}}" role="tabpanel">

                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>


