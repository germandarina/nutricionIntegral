<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: none !important;">
            <h5 class="modal-title">Descripción del Día {{ $day }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div>

                <div class="row mt-1">
                    {{ html()->label('Descripción')
                                ->class('col-md-2 form-control-label')
                                ->for('day_description') }}
                    <div class="col-md-8">
                        {{ html()->text('day_description',$plan_detail ? $plan_detail->day_description : null)
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
            <a href="#" class="btn btn-success" onclick="addDayDescription(event,{{$day}})">Agregar</a>
        </div>
    </div>
</div>



