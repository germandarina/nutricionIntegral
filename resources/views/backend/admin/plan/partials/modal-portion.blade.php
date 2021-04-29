<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: none !important;">
            <h5 class="modal-title">Editar Porción - {{ $plan_detail->recipe->name }} - <span style="color: orangered;">Rinde {{ $plan_detail->recipe->portions }} Porcion/es</span></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div>
                <div class="row mt-1">
                    {{ html()->label('Porción agregada al plan')
                                ->class('col-md-3 form-control-label')
                                ->for('portions') }}
                    <div class="col-md-8">
                        {{ html()->input('number','portions',$plan_detail->portions)
                            ->class('form-control')
                        }}
                    </div><!--col-->
                </div>
                <div class="row">
                       <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-modal-create" type="button" data-dismiss="modal">Cerrar</button>
            <a href="#" class="btn btn-primary" onclick="editPortion(event,{{$plan_detail->id}})">Actualizar</a>
        </div>
    </div>
</div>



