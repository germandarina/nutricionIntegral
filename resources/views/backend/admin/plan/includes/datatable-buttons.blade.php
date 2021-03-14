@if(!$row->trashed())
<div class="btn-group btn-group-sm" role="group" >
    @if ($row->open)
        <a title="Agregar Recetas" href='{{ route("admin.plan.addRecipes",['id'=>$row->id]) }}' class="btn btn-success"><i class="fas fa-plus-square" data-toggle="tooltip" data-placement="top" title="Agregar Recetas"></i></a>
        <a title="Modificar" href='{{ route("admin.plan.edit",['id'=>$row->id]) }}' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
        <a title="Eliminar" href="#" data-url="{{ route("admin.plan.destroy",['id'=>$row->id]) }}" onclick="eliminarItem(event,$(this))" class="btn btn-danger btn-xs delete-item" ><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
    @else
        <a title="Ver Plan" href='{{ route("admin.plan.addRecipes",['id'=>$row->id]) }}' class="btn btn-success"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver Plan"></i></a>
        <a title="Ver Datos" href='{{ route("admin.plan.edit",['id'=>$row->id]) }}' class="btn btn-primary"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver Datos"></i></a>
        <div class="dropdown">
            <button class="btn btn-dark btn-sm dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-download"></i></button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="will-change: transform; margin: 0px;">
                <a title="Descargar Plan PDF" href='{{route('admin.plan.downloadPlan',['id'=>$row->id])}}'  class="dropdown-item"><i class="fas fa-file-pdf" data-toggle="tooltip" data-placement="top" title="Descargar Plan PDF"></i> PDF Básico</a>
                <a title="Descargar Plan PDF" href='{{route('admin.plan.downloadPlan',['id'=>$row->id,'macros'=>true])}}'  class="dropdown-item"><i class="fas fa-file-pdf" data-toggle="tooltip" data-placement="top" title="Descargar Plan PDF"></i> PDF con Macros</a>
                <a title="Descargar Plan Word" href='{{route('admin.plan.downloadPlanWord',['id'=>$row->id])}}'  class="dropdown-item"><i class="fas fa-file-word" data-toggle="tooltip" data-placement="top" title="Descargar Plan Word"></i> Word Básico</a>
                <a title="Descargar Plan Word" href='{{route('admin.plan.downloadPlanWord',['id'=>$row->id,'macros'=>true])}}'  class="dropdown-item"><i class="fas fa-file-word" data-toggle="tooltip" data-placement="top" title="Descargar Plan Word"></i> Word con Macros</a>
            </div>
        </div>
    @endif
</div>
@else
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Restaurar" href="#" data-url="{{ route("admin.plan.restore",['id'=>$row->id]) }}" onclick="restaurarItem(event,$(this))" class="btn btn-info btn-sm restore-item"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="Restaurar"></i></a>
    </div>
@endif
