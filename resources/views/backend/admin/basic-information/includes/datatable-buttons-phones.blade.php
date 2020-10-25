<div class="btn-group btn-group-sm" role="group" >
    <a title="Eliminar" href='#' data-url="{{ route("admin.basic-information.deletePhone",['id'=>$row->id]) }}" onclick="eliminarItem(event,$(this))" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
</div>
