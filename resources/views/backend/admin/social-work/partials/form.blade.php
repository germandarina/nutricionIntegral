    <div class="row mt-4">
        <div class="col">
            <div class="form-group row">
                {{ html()->label('Nombre/s')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}

                <div class="col-md-6">
                    {{ html()->text('name')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.roles.name'))
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
            <div class="form-group row">
                {{ html()->label('Telefono')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}

                <div class="col-md-6">
                    {{ html()->text('phone')
                        ->class('form-control')
                        ->placeholder('Telefono')
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
            <div class="form-group row">
                {{ html()->label('Email')
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}

                <div class="col-md-6">
                    {{ html()->text('email')
                        ->class('form-control')
                        ->placeholder('Email')
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
