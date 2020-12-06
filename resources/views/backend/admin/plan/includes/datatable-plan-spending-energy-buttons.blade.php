@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Eliminar" href="#"  onclick="deleteEnergySpending(event,{{$row->id}})" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
    </div>
@endif
