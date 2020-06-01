@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Ver" href='#' onclick="verReceta(event,{{$row->recipe_id}})" class="btn btn-info"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></a>
        <a title="Eliminar" href="#"  onclick="eliminarRecetaPorDia(event,{{$row->id}})" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
    </div>
@endif
