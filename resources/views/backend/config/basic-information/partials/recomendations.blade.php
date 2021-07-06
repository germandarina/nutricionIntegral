<div class="row">
    <div class="col-md-6 col-xs-12 offset-md-3">
        {{ html()->label('Origen')
            ->class('col-md-1 form-control-label')
            ->for('origin') }}

        <div class="col-md-12">
            {{ html()->select('origin',\App\Models\Recommendation::$origins)
                ->class('form-control')
                ->required()
                ->attributes(['onchange'=>'controlOrigin()'])
                 }}
        </div><!--col-->
    </div>
    <div class="col-md-6 col-xs-12 offset-md-3">
        {{ html()->label('Tipo')
            ->class('col-md-1 form-control-label')
            ->for('type') }}

        <div class="col-md-12">
            {{ html()->select('type',\App\Models\Recommendation::$types)
                ->class('form-control')
                ->required()
                ->attributes(['onchange'=>'showRecommendationByType()'])
                 }}
        </div><!--col-->
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6 col-xs-12 offset-md-3" id="div_patient_recommendation" style="display: none;">
        <div class="form-group">
            {{ html()->label('Pacientes')
               ->class('col-md-2 form-control-label')
               ->for('patient_id') }}

            <div class="col-md-12">
                {{ html()->multiselect('patient_id',[])
                                ->class('form-control')
                                ->attribute("id","patient_id")
                                ->required()
                                }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
    <div id="div_recommendation" class="col-md-6 col-xs-12 offset-md-3">
        {{ html()->label('Recomendación')
           ->class('col-md-3 form-control-label')
           ->for('recommendation') }}

        <div class="col-md-12" style="display: none; margin-right: 0px !important;" id="divTxt">
            {{ html()->textarea('recommendation_text')
                ->class('form-control')
                ->placeholder('Recomendación')
                ->attribute('id', 'recommendation_text')
                ->attribute('rows', 3)
                ->required()
                ->autofocus() }}
        </div><!--col-->

        <div class="col-md-12" style="display: none; margin-right: 0px !important;" id="divImg">
            <input type="file"
               id="recommendation_img" name="recommendation_img"
               accept="image/png, image/jpeg, image/jpg"
               onchange="controlImage(event)"
               class="form-control">
        </div><!--col-->
    </div>
    <div class="col-md-6 col-xs-12 mt-4 offset-md-3">
        <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-success btn-block" onclick="storeRecommendation(event)">Guardar</a>
        </div><!--col-->
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <table class="table data-table font-xs " id="recommendation-datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>Origen</th>
                    <th>Tipo</th>
                    <th>Recomendación</th>
                    <th>Pacientes</th>
                    <th class="not-export-col">Acción</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
