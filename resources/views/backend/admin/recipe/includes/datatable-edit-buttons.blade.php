@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Ver Receta" rel="tooltip" href="#"  onclick="viewRecipe(event, {{ $row->id }} )" class="btn btn-info btn-xs " ><i class="fas fa-eye" rel="tooltip" data-placement="top" title="Ver Receta"></i></a>
        <a title="Pasar a Receta Oficial" rel="tooltip" href="#"  onclick="updateRecipe(event, {{ $row->id }} )" class="btn btn-warning btn-xs " ><i class="fas fa-edit" rel="tooltip" data-placement="top" title="Pasar a Receta Oficial"></i></a>
    </div>
@endif
