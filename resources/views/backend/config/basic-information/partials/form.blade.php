
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Nombre y Apellido')
                ->class('col-md-2 form-control-label')
                ->for('full_name') }}
            <div class="col-md-6">
                {{ html()->text('full_name')
                    ->class('form-control')
                    ->placeholder('Nombre y Apellido')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Nombre Empresa')
                ->class('col-md-2 form-control-label')
                ->for('company_name') }}
            <div class="col-md-6">
                {{ html()->text('company_name')
                    ->class('form-control')
                    ->placeholder('Nombre Empresa')
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('E-mail')
                ->class('col-md-2 form-control-label')
                ->for('email') }}
            <div class="col-md-6">
                {{ html()->text('email')
                    ->class('form-control')
                    ->placeholder('E-mail')
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Dirección')
                ->class('col-md-2 form-control-label')
                ->for('name') }}
            <div class="col-md-6">
                {{ html()->text('address')
                    ->class('form-control')
                    ->placeholder('Dirección')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Matrícula Profesional')
                ->class('col-md-2 form-control-label')
                ->for('m_professional') }}

            <div class="col-md-6">
                {{ html()->text('m_professional')
                    ->class('form-control')
                    ->placeholder('Matrícula Profesional')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Mostrar Día Próxima Consulta')
                ->class('col-md-2 form-control-label')
                ->for('frequency_days') }}

            <div class="col-md-6">
                {{ html()->select('show_frequency_days',\App\Models\BasicInformation::$show_frequency,isset($basic_information) ? $basic_information->show_frequency_days : 1)
                    ->class('form-control')
                    ->attributes(['onchange'=>'showFrequencyDays()'])
                    ->required()
                     }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4" id="div_frenquency_days">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Días Estimados de la Próxima Consulta del Paciente')
                ->class('col-md-2 form-control-label')
                ->for('frequency_days') }}

            <div class="col-md-6">
                {{ html()->input('number','frequency_days',isset($basic_information) ? $basic_information->frequency_days : 30)
                    ->class('form-control')
                    ->placeholder('Días Estimados de la Próxima Consulta del Paciente')
                    ->attribute('max', 60)
                    ->attribute('min',1)
                    ->required()
                    ->autofocus()
                     }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Nueva Imagen para PDF')
                ->class('col-md-2 form-control-label')
                ->for('image') }}

            <div class="col-md-6">
                <input type="file"
                       id="image" name="image"
                       accept="image/png, image/jpeg, image/jpg"
                       class="form-control">
            </div><!--col-->
        </div>
    </div>
</div>

@if(isset($basic_information))
    <div class="row mt-4">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Imagen cargada')
                    ->class('col-md-2 form-control-label')
                    ->for('image') }}

                <div class="col-md-6">
                    {{
                        html()->img(asset('img/backend/client/'.$basic_information->path_image))
                                ->attribute('width',800)
                                ->attribute('height',400)
                                ->class('responsive img-fluid')
                        }}
                </div><!--col-->
            </div>
        </div>
    </div>

    <div class="col text-right">
        {{ form_submit(__('buttons.general.crud.update')) }}
    </div>
@else
    <div class="col text-right">
        {{ form_submit(__('buttons.general.crud.create')) }}
    </div>
@endif



