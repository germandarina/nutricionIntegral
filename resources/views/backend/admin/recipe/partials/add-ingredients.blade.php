<div class="row">
    {{ html()->label('Alimento')
               ->class('col-md-2 form-control-label')
               ->for('food_id') }}
    <div class="col-md-9">
        {{ html()->select('food_id',[])
            ->class('form-control')
            ->placeholder('Buscar alimento...')
            ->attribute("id","food_id")
            ->attributes(['onchange'=>'getComposicionBasica(),limpiarCantidades()'])
            ->required()
            }}
    </div><!--col-->
</div>
<br>
<div id="divComposicion">

</div>
<div class="row">
    {{ html()->label('Desc. de Cant.')
                ->class('col-md-2 form-control-label')
                ->for('quantity_description') }}
    <div class="col-md-9">
        {{ html()->text('quantity_description')
            ->class('form-control')
            ->placeholder('1/2 taza, 1 cucharada, etc')
            ->attribute('maxlength', 191)
            ->required()
            ->autofocus() }}
    </div><!--col-->

</div>
<br>
<div class="row">
    {{ html()->label('Cant. en Grs')
                ->class('col-md-2 form-control-label')
                ->for('quantity_grs') }}
    <div class="col-md-9">
        {{ html()->text('quantity_grs')
            ->class('form-control')
            ->placeholder('100, 80, etc.')
            ->value(0)
            ->attributes(['onchange'=>'calculateGrs()'])
            ->autofocus() }}
    </div><!--col-->
</div>
<div id="divCalculate" class="mt-3">

</div>
<input type="hidden" id="ingredient_id" name="ingredient_id">
