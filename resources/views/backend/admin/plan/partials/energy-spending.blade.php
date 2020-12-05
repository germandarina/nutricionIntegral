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
                    ->attributes(['onchange'=>'useActivity(event)'])
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
                          ->attribute('min',0)
                          ->attribute('max',300)
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
                          ->attribute('min',0)
                          ->attribute('max',220)
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
                {{ html()->input('number','age')
                          ->class('form-control')
                          ->placeholder('Edad')
                          ->required()
                          ->attribute('min',0)
                          ->attribute('max',100)
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

<div class="row mt-1" id="divActivity">
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
        <a href="#" class="btn btn-primary btn-block" onclick="calculate(event)"><i class="fas fa-calculator"></i> Calcular</a>
    </div><!--col-->
</div><!--row-->

<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Resultado')
                ->class('col-md-2 form-control-label label-result')
                ->for('method_result') }}
            <div class="col-md-6">
                {{ html()->text('method_result')
                          ->class('form-control numeric3Digits')
                          ->placeholder('Resultado')
                          ->readonly()
                          ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

<div class="row mt-1" id="divStoreSpendingEnergy" style="display: none;">
    <div class="col col-sm-6 offset-2">
        <a href="#" class="btn btn-success btn-block" onclick="storeSpendingEnergy(event)"><i class="fas fa-save"></i> Guardar</a>
    </div><!--col-->
</div><!--row-->

<div id="divFaoOms" style="display: none;">
    <hr>
    <div class="row">
        <div class="col-sm-5">
            <h5 class="card-title mb-0">
                <button class="btn btn-success btn-sm" type="button" onclick="modalFao(event)" >Agregar Actividad <i class="fas fa-plus-circle"></i></button>
            </h5>
        </div><!--col-->
    </div><!--row-->
    <br>
    @include('backend.admin.plan.partials.datatable-energy-spending')
</div>

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

