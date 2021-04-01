    <div class="row mt-4">
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
