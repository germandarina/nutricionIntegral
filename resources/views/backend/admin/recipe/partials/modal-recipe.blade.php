<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: none !important;">
            <h5 class="modal-title">{{ $recipe->name }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm table-sm table-condensed font-xs">
                     <thead>
                         <tr>
                             <th>Ingrediente</th>
                             <th style="text-align: right;">Cantidad (gr)</th>
                             <th style="text-align: center;">Descripción</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($recipe->ingredients as $ingredient)
                            <tr>
                                <td>{{$ingredient->food->name}}</td>
                                <td style="text-align: right;">{{$ingredient->quantity_grs}}</td>
                                <td style="text-align: center;">{{$ingredient->quantity_description}}</td>
                            </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
            <hr>
            @include('backend.admin.recipe.partials.table-total-recipe')
            <hr>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-modal-create" type="button" data-dismiss="modal">Cerrar</button>
            <button id="btnEditar" class="btn btn-warning btn-modal-edit" type="button" onclick="updateRecipe(event,{{ $recipe->id }})">Pasar a Receta Oficial</button>
        </div>
    </div>
</div>



