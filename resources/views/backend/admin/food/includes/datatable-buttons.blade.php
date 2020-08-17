@if(!$row->trashed())
<div class="btn-group btn-group-sm" role="group" >
    <a title="Modificar" href='{{ route("admin.food.edit",['id'=>$row]) }}' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
    <a title="Eliminar" href="#" data-url="{{ route("admin.food.destroy",['id'=>$row]) }}" onclick="eliminarItem(event,$(this))" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
</div>
@else
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Restaurar" href="#" data-url="{{ route("admin.food.restore",['id'=>$row]) }}" onclick="restaurarItem(event,$(this))" class="btn btn-info btn-sm restore-item"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="Restaurar"></i></a>
    </div>
@endif
