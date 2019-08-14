@if(!$row->trashed())
<div class="btn-group btn-group-sm" role="group" >
    <a title="Modificar" href='{{ route("admin.employee.edit",['id'=>$row->id]) }}' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
    <a title="Eliminar" href="{{ route("admin.employee.destroy",['id'=>$row->id]) }}" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
</div>
@else
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Restaurar" href="{{ route("admin.employee.restore",['id'=>$row->id]) }}" class="btn btn-info btn-sm restore-item"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="Restaurar"></i></a>
    </div>
@endif
