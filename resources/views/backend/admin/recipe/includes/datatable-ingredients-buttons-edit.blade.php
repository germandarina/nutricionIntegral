@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Modificar" href='#' onclick="modificarIngrediente(event,{{$row->id}})" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
        <a title="Eliminar" href="#"  onclick="eliminarIngrediente(event,{{$row->id}})" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
    </div>
@endif
