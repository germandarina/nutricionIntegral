<div class="row">
    <div class="col-sm-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs" role="tablist">
            @if($plan->open)
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#add-recipes" role="tab" aria-controls="add-recipes"><strong>Agregar Recetas</strong></a></li>
            @endif
            @for($i=1;$i<=$plan->days;$i++)
                <li class="nav-item"><a class="nav-link  @if(!$plan->open && $i == 1) active @endif " data-toggle="tab" href="#day-{{$i}}" role="tab" aria-controls="day-{{$i}}">Día {{$i}}</a></li>
            @endfor
            </ul>
            <div class="tab-content">
                @if($plan->open)
                    <div class="tab-pane active" id="add-recipes" role="tabpanel">
                         @include('backend.admin.plan.partials.add-recipes')
                    </div>
                @endif
                @for($i=1;$i<=$plan->days;$i++)
                    <div class="tab-pane @if(!$plan->open && $i == 1) active @endif" id="day-{{$i}}" role="tabpanel">
                        @include('backend.admin.plan.partials.recipes-by-day')
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>


