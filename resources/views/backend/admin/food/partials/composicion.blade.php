<div class="row">
    <div class="col-md-2">
        {{ html()->label('Energia Kj')
                 ->class('col-md-12 form-control-label')
                 ->for('energia_kj') }}
        {{ html()->text('energia_kj')
                 ->class('form-control numeric3Digits')
                 ->placeholder('Energia Kj')
                 ->attribute('maxlength', 191)
                 ->required()
                 ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Energia Kcal')
                 ->class('col-md-12 form-control-label')
                 ->for('energia_kcal') }}
        {{ html()->text('energia_kcal')
                ->class('form-control numeric3Digits')
                ->placeholder('Energia Kcal')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Agua')
                ->class('col-md-12 form-control-label')
                ->for('agua') }}
        {{ html()->text('agua')
            ->class('form-control numeric3Digits')
            ->placeholder('Agua')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Proteínas')
                 ->class('col-md-12 form-control-label')
                 ->for('proteinas') }}
        {{ html()->text('proteinas')
            ->class('form-control numeric3Digits')
            ->placeholder('Proteínas')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Grasa Total')
                 ->class('col-md-12 form-control-label')
                 ->for('grasa_total') }}
        {{ html()->text('grasa_total')
                 ->class('form-control numeric3Digits')
                 ->placeholder('Grasa Total')
                 ->attribute('maxlength', 191)
                 ->required()
                 ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Carbohidratos T')
                 ->class('col-md-12 form-control-label')
                 ->for('carbohidratos_totales') }}
        {{ html()->text('carbohidratos_totales')
                ->class('form-control numeric3Digits')
                ->placeholder('Carbohidratos Totales')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
    </div><!--col-->
</div>
<br>
<div class="row">
    <div class="col-md-2">
        {{ html()->label('Cenizas')
                ->class('col-md-12 form-control-label')
                ->for('cenizas') }}
        {{ html()->text('cenizas')
            ->class('form-control numeric3Digits')
            ->placeholder('Cenizas')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Sodio')
                 ->class('col-md-12 form-control-label')
                 ->for('sodio') }}
        {{ html()->text('sodio')
            ->class('form-control numeric3Digits')
            ->placeholder('Sodio')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Potasio')
                 ->class('col-md-12 form-control-label')
                 ->for('potasio') }}
        {{ html()->text('potasio')
                 ->class('form-control numeric3Digits')
                 ->placeholder('Potasio')
                 ->attribute('maxlength', 191)
                 ->required()
                 ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Calcio')
                 ->class('col-md-12 form-control-label')
                 ->for('calcio') }}
        {{ html()->text('calcio')
                ->class('form-control numeric3Digits')
                ->placeholder('Calcio')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Fósforo')
                ->class('col-md-12 form-control-label')
                ->for('fosforo') }}
        {{ html()->text('fosforo')
            ->class('form-control numeric3Digits')
            ->placeholder('Fósforo')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Hierro')
                 ->class('col-md-12 form-control-label')
                 ->for('hierro') }}
        {{ html()->text('hierro')
            ->class('form-control numeric3Digits')
            ->placeholder('Hierro')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div>
<br>
<div class="row">
    <div class="col-md-2">
        {{ html()->label('Zinc')
                ->class('col-md-12 form-control-label')
                ->for('zing') }}
        {{ html()->text('zing')
            ->class('form-control numeric3Digits')
            ->placeholder('Zinc')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Tiamina')
                 ->class('col-md-12 form-control-label')
                 ->for('tiamina') }}
        {{ html()->text('tiamina')
            ->class('form-control numeric3Digits')
            ->placeholder('Tiamina')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Rivoflavina')
                 ->class('col-md-12 form-control-label')
                 ->for('rivoflavina') }}
        {{ html()->text('rivoflavina')
                 ->class('form-control numeric3Digits')
                 ->placeholder('Rivoflavina')
                 ->attribute('maxlength', 191)
                 ->required()
                 ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Niacina')
                ->class('col-md-12 form-control-label')
                ->for('niacina') }}
        {{ html()->text('niacina')
            ->class('form-control numeric3Digits')
            ->placeholder('Niacina')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Vitamina C')
                 ->class('col-md-12 form-control-label')
                 ->for('vitamina_c') }}
        {{ html()->text('vitamina_c')
            ->class('form-control numeric3Digits')
            ->placeholder('Vitamina C')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Carbohidratos Disp')
                ->class('col-md-12 form-control-label')
                ->for('carbohidratos_disponibles') }}
        {{ html()->text('carbohidratos_disponibles')
            ->class('form-control numeric3Digits')
            ->placeholder('Carbohidratos Disp')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div>
<br>
<div class="row">

    <div class="col-md-2">
        {{ html()->label('Ac Grasos Satu')
                 ->class('col-md-12 form-control-label')
                 ->for('ac_grasos_saturados') }}
        {{ html()->text('ac_grasos_saturados')
            ->class('form-control numeric3Digits')
            ->placeholder('Ac Grasos Satu')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Ac Grasos Mono')
                 ->class('col-md-12 form-control-label')
                 ->for('ac_grasos_monoinsaturados') }}
        {{ html()->text('ac_grasos_monoinsaturados')
                 ->class('form-control numeric3Digits')
                 ->placeholder('Ac Grasos Mono')
                 ->attribute('maxlength', 191)
                 ->required()
                 ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Ac Grasos Poli')
                 ->class('col-md-12 form-control-label')
                 ->for('ac_grasos_poliinsaturados') }}
        {{ html()->text('ac_grasos_poliinsaturados')
                ->class('form-control numeric3Digits')
                ->placeholder('Ac Grasos Poli')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Colesterol')
                ->class('col-md-12 form-control-label')
                ->for('colesterol') }}
        {{ html()->text('colesterol')
            ->class('form-control numeric3Digits')
            ->placeholder('Colesterol')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div>
