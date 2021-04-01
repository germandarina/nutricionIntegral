<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Tipo')
                ->class('col-md-1 form-control-label')
                ->for('type') }}

            <div class="col-md-2">
                {{ html()->select('type',\App\Models\Recommendation::$types)
                    ->class('form-control')
                    ->required()
                    ->attributes(['onchange'=>'showRecommendationByType()'])
                     }}
            </div><!--col-->

            {{ html()->label('Recomendación')
               ->class('col-md-2 form-control-label')
               ->for('recommendation') }}

            <div class="col-md-6" style="display: none;" id="divTxt">
                {{ html()->text('recommendation_text')
                    ->class('form-control')
                    ->placeholder('Recomendación')
                    ->attribute('id', 'recommendation_text')
                    ->required()
                    ->autofocus() }}
            </div><!--col-->

            <div class="col-md-6" style="display: none;" id="divImg">
                <input type="file"
                   id="recommendation_img" name="recommendation_img"
                   accept="image/png, image/jpeg, image/jpg"
                   onchange="controlImage(event)"
                   class="form-control">
            </div><!--col-->

            <div class="col-md-1">
                <a href="#" class="btn btn-sm btn-success" onclick="storeRecommendation(event)">Guardar</a>
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <table class="table data-table font-xs " id="recommendation-datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Recomendación</th>
                    <th class="not-export-col">Acción</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
