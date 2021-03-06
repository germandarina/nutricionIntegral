    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Paciente')
                                   ->class('col-md-2 form-control-label')
                                   ->for('patient_id') }}
                <div class="col-md-6">
                    {{ html()->select('patient_id',[])
                        ->class('form-control')
                        ->placeholder('Buscar paciente...')
                        ->attribute("id","patient_id")
                        ->required()
                        }}
                </div><!--col-->
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Nombre')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}
                <div class="col-md-6">
                    {{ html()->text('name')
                        ->class('form-control')
                        ->placeholder('Nombre')
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Cant. Días')
                    ->class('col-md-2 form-control-label')
                    ->for('days') }}
                <div class="col-md-6">
                    {{ html()->input('number','days',isset($plan) ? $plan->days: 7)
                        ->class('form-control')
                        ->placeholder('Cant Días')
                        ->attribute('min',7)
                        ->attribute('max',30)
                        ->required()
                        ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
