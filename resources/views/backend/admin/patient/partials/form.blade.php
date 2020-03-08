
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Nombre y Apellido')
                ->class('col-md-4 form-control-label')
                ->for('full_name') }}
            <div class="col-md-8">
                {{ html()->text('full_name')
                    ->class('form-control')
                    ->placeholder('Nombre y Apellido')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Documento')
                ->class('col-md-4 form-control-label')
                ->for('name') }}
            <div class="col-md-8">
                {{ html()->input('number','document')
                    ->class('form-control')
                    ->placeholder('Documento')
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Edad')
                ->class('col-md-4 form-control-label')
                ->for('age') }}
            <div class="col-md-8">
                {{ html()->input('number','age')
                    ->class('form-control')
                    ->placeholder('Edad')
                    ->attribute('min', 1)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Fecha de Nacimiento')
                ->class('col-md-4 form-control-label')
                ->for('birthdate') }}
            <div class="col-md-8">
                {{ html()->date('birthdate')
                    ->class('form-control')
                    ->placeholder('Fecha de Nacimiento')
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
            {{ html()->label('Direccion')
                ->class('col-md-4 form-control-label')
                ->for('name') }}
            <div class="col-md-8">
                {{ html()->text('address')
                    ->class('form-control')
                    ->placeholder('Direccion')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Telefono')
                ->class('col-md-4 form-control-label')
                ->for('name') }}

            <div class="col-md-8">
                {{ html()->text('phone')
                    ->class('form-control')
                    ->placeholder('Telefono')
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
            {{ html()->label('Email')
                ->class('col-md-4 form-control-label')
                ->for('name') }}

            <div class="col-md-8">
                {{ html()->text('email')
                    ->class('form-control')
                    ->placeholder('Email')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
    <div class="col">
        <div class="form-group row">
            {{ html()->label('Cant. de Hijos')
                ->class('col-md-4 form-control-label')
                ->for('number_of_children') }}

            <div class="col-md-8">
                {{ html()->input('number','number_of_children')
                    ->class('form-control')
                    ->placeholder('Cantidad de Hijos')
                    ->attribute('min', 0)
                    ->required()
                    ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <div class="form-group row">
        {{ html()->label('Motivo')
            ->class('col-md-4 form-control-label')
            ->for('motive') }}

        <div class="col-md-12">
            {{ html()->textarea('motive')
                ->class('form-control')
                ->placeholder('Motivo')
                ->attribute('maxlength', 500)
                ->required()
                ->autofocus() }}
        </div><!--col-->
    </div>
    </div>
</div>
    {{ html()->hidden('id',isset($patient) ? $patient->id : null) }}
