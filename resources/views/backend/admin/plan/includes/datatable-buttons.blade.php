@if(!$row->trashed())
    <div class="dropdown">
        <button class="btn btn-dark btn-sm dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="will-change: transform; margin: 0px;">
            @if ($row->open)
                <a title="Agregar Recetas" href='{{ route("admin.plan.addRecipes",['id'=>$row->id]) }}' class="dropdown-item"><i style="color:green;" class="fas fa-plus-square" data-toggle="tooltip" data-placement="top" title="Agregar Recetas"></i> <strong>Agregar Receta</strong></a>
                <a title="Modificar" href='{{ route("admin.plan.edit",['id'=>$row->id]) }}' class="dropdown-item"><i style="color: darkblue;" class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i> <strong>Modificar Info Plan</strong></a>
                <a title="Eliminar" href="#" data-url="{{ route("admin.plan.destroy",['id'=>$row->id]) }}" onclick="eliminarItem(event,$(this))" class="dropdown-item delete-item" ><i style="color: red;" class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i> <strong>Eliminar</strong></a>
            @else
                <a title="Ver Plan" href='{{ route("admin.plan.addRecipes",['id'=>$row->id]) }}' class="dropdown-item"><i style="color:green;" class="fas fa-receipt" data-toggle="tooltip" data-placement="top" title="Ver Plan"></i> <strong>Ver Plan</strong></a>
                <a title="Ver Datos" href='{{ route("admin.plan.edit",['id'=>$row->id]) }}' class="dropdown-item"><i style="color:darkblue;" class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver Datos"></i> <strong>Ver Info Plan</strong></a>
                <a title="Descargar PDF" href='{{route('admin.plan.downloadPlan',['id'=>$row->id])}}'  class="dropdown-item"><i style="color:red;" class="fas fa-file-pdf" data-toggle="tooltip" data-placement="top" title="Descargar PDF"></i> PDF Básico</a>
                <a title="Descargar PDF" href='{{route('admin.plan.downloadPlan',['id'=>$row->id,'macros'=>true])}}'  class="dropdown-item"><i style="color:red;" class="fas fa-file-pdf" data-toggle="tooltip" data-placement="top" title="Descargar PDF"></i> PDF con Macros</a>
{{--                <a title="Descargar Plan Word" href='{{route('admin.plan.downloadPlan',['id'=>$row->id,'word'=>true])}}'  class="dropdown-item"><i class="fas fa-file-word" data-toggle="tooltip" data-placement="top" title="Descargar Plan Word"></i> Word Básico</a>--}}
{{--                <a title="Descargar Plan Word" href='{{route('admin.plan.downloadPlan',['id'=>$row->id,'macros'=>true,'word'=>true])}}'  class="dropdown-item"><i class="fas fa-file-word" data-toggle="tooltip" data-placement="top" title="Descargar Plan Word"></i> Word con Macros</a>--}}
            @endif
        </div>
    </div>
@else
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Restaurar" href="#" data-url="{{ route("admin.plan.restore",['id'=>$row->id]) }}" onclick="restaurarItem(event,$(this))" class="btn btn-info btn-sm restore-item"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="Restaurar"></i></a>
    </div>
@endif

<style>
    .dropdown-menu a {
        font-size: 11px;
    }
</style>
