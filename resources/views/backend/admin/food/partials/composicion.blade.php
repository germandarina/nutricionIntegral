<div class="row">
    <div class="col-md-2">
        {{ html()->label('Energia (Kj)')
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
        {{ html()->label('Energia (Kcal)')
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
        {{ html()->label('Agua (g)')
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
        {{ html()->label('Proteínas (g)')
                 ->class('col-md-12 form-control-label')
                 ->for('proteina') }}
        {{ html()->text('proteina')
            ->class('form-control numeric3Digits')
            ->placeholder('Proteínas')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->
    <div class="col-md-2">
        {{ html()->label('Grasa Total (g)')
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
        {{ html()->label('Carbo Totales (g)')
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
        {{ html()->label('Cenizas (g)')
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
        {{ html()->label('Sodio (mg)')
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
        {{ html()->label('Potasio (mg)')
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
        {{ html()->label('Calcio (mg)')
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
        {{ html()->label('Fósforo (mg)')
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
        {{ html()->label('Hierro (mg)')
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
        {{ html()->label('Zinc (mg)')
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
        {{ html()->label('Tiamina (mg)')
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
        {{ html()->label('Rivoflavina (mg)')
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
        {{ html()->label('Niacina (mg)')
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
        {{ html()->label('Vitamina C (mg)')
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
        {{ html()->label('Carbo Disp (g)')
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
        {{ html()->label('A. Grasos Satu (g)')
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
        {{ html()->label('A. Grasos Mono (g)')
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
        {{ html()->label('A. Grasos Poli (g)')
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
        {{ html()->label('Colesterol (mg)')
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
