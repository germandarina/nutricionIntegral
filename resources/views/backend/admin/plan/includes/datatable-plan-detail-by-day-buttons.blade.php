@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Ver Receta" href='#' onclick="showRecipe(event,{{$row->recipe_id}},{{$row->id}})" class="btn btn-info"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver Receta"></i></a>
        <a title="Ver Observaciones" href='#' onclick="showObservations(event,{{$row->id}})" class="btn btn-dark"><i class="fas fa-list-ol" data-toggle="tooltip" data-placement="top" title="Ver Observaciones"></i></a>
        <a title="Eliminar" href="#"  onclick="deleteRecipeByDay(event,{{$row->id}})" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
    </div>
@endif
