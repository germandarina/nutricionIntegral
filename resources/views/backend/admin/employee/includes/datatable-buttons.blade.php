<div class="btn-group btn-group-sm" role="group" aria-label="labels.backend.access.users.user_actions">
    <a href='{{ route("admin.employee.edit",['id'=>$row->id]) }}' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
    <a href="{{ route("admin.employee.destroy",['id'=>$row->id]) }}" class="btn btn-danger btn-xs delete-item" title="Eliminar Empleado"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
</div>
