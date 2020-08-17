@if(!$row->trashed())
<div class="btn-group btn-group-sm" role="group" >
    <a title="Agregar Recetas" href='{{ route("admin.plan.addRecipes",['id'=>$row->id]) }}' class="btn btn-success"><i class="fas fa-plus-square" data-toggle="tooltip" data-placement="top" title="Agregar Recetas"></i></a>
    <a title="Total Composición" href='#' onclick="getTotalComposicionForPlan(event,{{ $row->id }})" class="btn btn-warning"><i class="fas fa-list" data-toggle="tooltip" data-placement="top" title="Total Composición"></i></a>
    <a title="Enviar Plan Por E-Mail" href='{{route('admin.plan.sendPlan',['id'=>$row->id])}}'  class="btn btn-dark"><i class="fas fa-at" data-toggle="tooltip" data-placement="top" title="Enviar Plan Por E-Mail"></i></a>
    <a title="Modificar" href='{{ route("admin.plan.edit",['id'=>$row->id]) }}' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
    <a title="Eliminar" href="#" data-url="{{ route("admin.plan.destroy",['id'=>$row->id]) }}" onclick="eliminarItem(event,$(this))" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
</div>
@else
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Restaurar" href="#" data-url="{{ route("admin.plan.restore",['id'=>$row->id]) }}" onclick="restaurarItem(event,$(this))" class="btn btn-info btn-sm restore-item"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="Restaurar"></i></a>
    </div>
@endif
