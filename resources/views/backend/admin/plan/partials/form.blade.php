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
                        //->attributes(['onchange'=>'getComposicionBasica()'])
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
                    {{ html()->input('number','days',7)
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
    <div class="row mt-1">
        <table>
            <thead>
                <tr>
                    <th>Necesidades Diarias</th>
                    <th style="text-align: right;">Valores</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>Energía (kcal)</td>
                <td>
                    {{ html()->text('energia_kcal_por_dia')
                               ->class('form-control numeric3Digits')
                               ->placeholder('Energia (kcal) necesarias por día')
                               ->required()
                               ->autofocus() }}
                </td>
            </tr>
            <tr>
                <td>Proteína (g)</td>
                <td>
                    {{ html()->text('proteina_por_dia')
                               ->class('form-control numeric3Digits')
                               ->placeholder('Proteína (g) necesaria por día')
                               ->required()
                               ->autofocus() }}
                </td>
            </tr>
            <tr>
                <td>Carbohidratos (g)</td>
                <td>
                    {{ html()->text('carbohidratos_por_dia')
                               ->class('form-control numeric3Digits')
                               ->placeholder('Carbohidratos (g) necesarios por día')
                               ->required()
                               ->autofocus() }}
                </td>
            </tr>
            <tr>
                <td>Grasa (g)</td>
                <td>
                    {{ html()->text('grasa_total_por_dia')
                               ->class('form-control numeric3Digits')
                               ->placeholder('Grasa Total Necesaria por día (g)')
                               ->required()
                               ->autofocus() }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
