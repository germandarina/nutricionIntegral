@foreach($recipes as $recipe)
    <div class="col-sm-4 mb-3" style="max-height: 30%;">
        <div class="card" style="margin-bottom: 0px !important;">
            <div class="accordion" id="accordion" role="tablist">
                <div class="card-header" id="header_{{$recipe->id}}" role="tab" style="font-size: 11px; padding: 7px;">
                    <a rel="tooltip" title="{{strtoupper($recipe->name)}}"
                       data-toggle="collapse"
                       href="#collapse_{{$recipe->id}}"
                       aria-expanded="true"
                       aria-controls="collapse_{{$recipe->id}}"
                       class=""><strong>{{substr(strtoupper($recipe->name),0,35)}}</strong></a>
                    <div class="card-header-actions">
                        <a class="btn btn-sm btn-success" href="#" onclick="modalAgregarReceta(event,{{$recipe->id}},null)">
                            <icon class="fas fa-plus-square"></icon>
                        </a>
                        <a class="btn btn-sm btn-warning" href="#" onclick="agregarYEditarReceta(event,{{$recipe->id}})">
                            <icon class="fas fa-pencil-alt"></icon>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="collapse_{{$recipe->id}}" role="tabpanel" aria-labelledby="header_{{$recipe->id}}" data-parent="#accordion" style="">
                    <div class="card-body" style="padding: 3px;">
                        <ul class="list-group">
                            <li style="padding: 3px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-sm"><strong>Energía (Kcal)</strong><span class="badge badge-info badge-pill"><strong>{{$recipe->total_energia_kcal }}</strong></span></li>
                            <li style="padding: 3px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-sm"><strong>Proteína (g)</strong><span class="badge badge-info badge-pill">{{$recipe->total_proteina}}</span></li>
                            <li style="padding: 3px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-sm"><strong>Carbohidratos (g)</strong><span class="badge badge-info badge-pill">{{$recipe->total_carbohidratos_totales}}</span></li>
                            <li style="padding: 3px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-sm"><strong>Grasa (g)</strong><span class="badge badge-info badge-pill">{{$recipe->total_grasa_total}}</span></li>
                            <li style="padding: 3px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-sm"><strong>Colesterol (g)</strong><span class="badge badge-info badge-pill">{{$recipe->total_colesterol}}</span></li>
                            <li style="padding: 3px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-sm">
                                <a href="#" class="btn btn-sm btn-success btn-block" onclick="getTotalCompleto(event,{{$recipe->id}})"><strong>Composicíon Total</strong></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
