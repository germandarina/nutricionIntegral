<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar Receta</h5>
        </div>
        <div class="modal-body">
            @include('backend.admin.recipe.partials.edit-ingredient')
            <p style="text-align: center; margin: 0;"><strong>Ingredientes</strong></p>
            @include('backend.admin.recipe.partials.datatable-ingredients')
            <div class="row mt-lg-2" id="divTotales"></div>
        </div>
        <input type="hidden" id="hidden_recipe_id" name="hidden_recipe_id" value="{{$recipe->id}}">
        <input type="hidden" id="ingredient_id" name="ingredient_id">
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>



