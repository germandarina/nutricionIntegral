
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
            {{ html()->label('Direccion')
                ->class('col-md-2 form-control-label')
                ->for('name') }}
            <div class="col-md-6">
                {{ html()->text('address')
                    ->class('form-control')
                    ->placeholder('Direccion')
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
            {{ html()->label('Nuev Imagen para PDF')
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
@endif


<div class="col text-right">
    {{ form_submit(__('buttons.general.crud.update')) }}
</div><!--col-->
