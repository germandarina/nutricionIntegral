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
    <hr>
    <div class="row">
        <div class="col-sm-5">
            <h5 class="card-title mb-0">
                <small class="text-muted">Cálculo Gasto Energético</small>
            </h5>
        </div><!--col-->
    </div><!--row-->
    <hr>
    <div class="row mt-2">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Método')
                    ->class('col-md-2 form-control-label')
                    ->for('method') }}
                <div class="col-md-6">
                    {{ html()->select('method',\App\Models\Plan::$methods)
                        ->class('form-control')
                        ->placeholder('Seleccione')
                    }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Peso (Kg)')
                    ->class('col-md-2 form-control-label')
                    ->for('weight') }}
                <div class="col-md-6">
                    {{ html()->text('weight')
                              ->class('form-control numericDigits')
                              ->placeholder('Peso (Kg)')
                              ->required()
                              ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Altura (Cm)')
                    ->class('col-md-2 form-control-label')
                    ->for('height') }}
                <div class="col-md-6">
                    {{ html()->text('height')
                              ->class('form-control numericDigits')
                              ->placeholder('Altura (Cm)')
                              ->required()
                              ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Edad')
                    ->class('col-md-2 form-control-label')
                    ->for('age') }}
                <div class="col-md-6">
                    {{ html()->text('age')
                              ->class('form-control')
                              ->placeholder('Edad')
                              ->required()
                              ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Sexo / Género')
                    ->class('col-md-2 form-control-label')
                    ->for('gender') }}
                <div class="col-md-6">
                    {{ html()->select('gender',\App\Models\Patient::$genders)
                              ->class('form-control')
                              ->placeholder('Seleccione')
                              ->required()
                               }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-1">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Actividad Física')
                    ->class('col-md-2 form-control-label')
                    ->for('activity') }}
                <div class="col-md-6">
                    {{ html()->select('activity',\App\Models\Plan::$activities)
                              ->class('form-control')
                              ->placeholder('Seleccione')
                              ->required()
                               }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-1">
        <div class="col col-sm-6 offset-2">
            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-calculator"></i> Calcular</a>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Resultado')
                    ->class('col-md-2 form-control-label')
                    ->for('method_result') }}
                <div class="col-md-6">
                    {{ html()->text('method_result')
                              ->class('form-control numeric3Digits')
                              ->placeholder('Resultado')
                              ->required()
                              ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
    <hr>
    <div class="row mt-1">
        <div class="col col-sm-6 offset-3">
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
    </div>
