@foreach($recipes as $recipe)
    <div class="col-sm-4 mb-3" style="max-height: 30%;">
        <div class="card" style="margin-bottom: 0px !important;">
            <div class="accordion" id="accordion" role="tablist">
                <div class="card-header" id="header_{{$recipe->id}}" role="tab" style="font-size: 11px; padding: 7px;">
                    <a rel="tooltip" title="{{$recipe->name}}"
                       data-toggle="collapse"
                       href="#collapse_{{$recipe->id}}"
                       aria-expanded="true"
                       aria-controls="collapse_{{$recipe->id}}"
                       class="">{{substr($recipe->name,0,35)}}</a>
                    <div class="card-header-actions">
                        <a class="btn btn-sm btn-success" href="#" onclick="modalAgregarReceta(event,{{$recipe->id}},null)">
                            <icon class="fas fa-plus-square"></icon>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="collapse_{{$recipe->id}}" role="tabpanel" aria-labelledby="header_{{$recipe->id}}" data-parent="#accordion" style="">
                    <div class="card-body" style="padding: 3px;">
                        <ul class="list-group">
                            <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Energía<span class="badge badge-info badge-pill">{{$recipe->total_energia_kcal }}</span></li>
                            <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Proteína<span class="badge badge-info badge-pill">{{$recipe->total_proteina}}</span></li>
                            <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Grasa<span class="badge badge-info badge-pill">{{$recipe->total_grasa_total}}</span></li>
                            <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Carbohidratos<span class="badge badge-info badge-pill">{{$recipe->total_carbohidratos_totales}}</span></li>
                            <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">Colesterol<span class="badge badge-info badge-pill">{{$recipe->total_colesterol}}</span></li>
                            <li style="padding: 1px; border: none;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center font-xs">
                                <a href="#" class="btn btn-xs btn-success btn-block" onclick="getTotalCompleto(event,{{$recipe->id}})">TOTAL COMPOSICION RECETA</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
