@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        @if ($row->activity != App\Models\PlanEnergySpending::act_minima_manutencion)
            <a title="Editar" href="#"  onclick="modalEditFao(event,{{$row->id}})" class="btn btn-primary btn-xs" ><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
        @endif
        <a title="Eliminar" href="#"  onclick="deleteEnergySpending(event,{{$row->id}})" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
    </div>
@endif
