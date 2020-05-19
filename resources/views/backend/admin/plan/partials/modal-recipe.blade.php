<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $recipe->name }} -  {{ $recipe->recipeType->name }}</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm table-sm table-condensed font-xs">
                     <thead>
                         <tr>
                             <th>Ingrediente</th>
                             <th>Cant. (gr)</th>
                             <th>Descripcion</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($recipe->ingredients as $ingredient)
                            <tr>
                                <td>{{$ingredient->food->name}}</td>
                                <td>{{$ingredient->quantity_description}}</td>
                                <td>{{$ingredient->quantity_grs}}</td>
                            </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
{{--            @include('backend.admin.recipe.partials.table-total-recipe')--}}
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
            <button id="btnGuardar" class="btn btn-primary" type="button" onclick="agregarReceta(event,{{$recipe->id}},'0')">Agregar</button>
            <button id="btnGuardar" class="btn btn-warning" type="button" onclick="agregarYEditarReceta(event,{{$recipe->id}})">Agregar y Editar</button>
        </div>
    </div>
</div>



