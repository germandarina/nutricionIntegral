<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar Receta</h5>
        </div>
        <div class="modal-body">
{{--            @include('backend.admin.recipe.partials.form-modal')--}}
            @include('backend.admin.recipe.partials.edit-ingredient')
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive" style="overflow-x: hidden !important;">
                        <table class="table data-table font-xs" id="table-ingredients">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Cantidad Grs</th>
                                <th class="not-export-col">Acciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-lg-2" id="divTotales">

            </div>
        </div>
        <input type="hidden" id="hidden_recipe_id" name="hidden_recipe_id" value="{{$recipe->id}}">
        <input type="hidden" id="old_ingredient_id" name="old_ingredient_id">
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>



