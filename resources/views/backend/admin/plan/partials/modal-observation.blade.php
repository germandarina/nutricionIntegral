<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: none !important;">
            <h5 class="modal-title">Observaciones</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div style="border: 1px solid #1abc9c; padding: 5px;">

                <div class="row mt-1">
                    {{ html()->label('Observaciones')
                                ->class('col-md-2 form-control-label')
                                ->for('observation') }}
                    <div class="col-md-8">
                        {{ html()->multiselect('observations',$observations,isset($observations_plan_detail) ? $observations_plan_detail : null)
                            ->class('form-control')
                            ->attributes(['onchange'=>"addObservation(event)"])
                        }}
                    </div><!--col-->
                </div>
                <hr>
                <h5>Nueva Observación</h5>
                <div class="row">
                    <div class="col-md-8">
                        {{ html()->textarea('observation')
                                            ->class('form-control')
                                            ->placeholder('')
                                            ->autofocus()
                         }}
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-success" onclick="addNewObservation(event,{{$plan_detail->id}})">Agregar Observación</a>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="hidden_plan_detail_id" id="hidden_plan_detail_id" value="{{ $plan_detail->id }}">

        <div class="modal-footer">
            <button class="btn btn-secondary btn-modal-create" type="button" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>



