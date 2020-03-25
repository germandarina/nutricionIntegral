<div class="row">
    {{ html()->label('Alimento')
               ->class('col-md-3 form-control-label')
               ->for('food_id') }}
    <div class="col-md-9">
        {{ html()->select('food_id',[])
            ->class('form-control')
            ->placeholder('Seleccione...')
            ->attribute("id","food_id")
            ->required()
            }}
    </div><!--col-->
</div>
<br>
<div class="row">
    {{ html()->label('Cantidad (Descripcion)')
                ->class('col-md-3 form-control-label')
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
    {{ html()->label('Cantidad (Grs)')
                ->class('col-md-3 form-control-label')
                ->for('quantity_grs') }}
    <div class="col-md-9">
        {{ html()->text('quantity_grs')
            ->class('form-control')
            ->placeholder('100, 80, etc.')
            ->value(0)
            ->autofocus() }}
    </div><!--col-->

</div>
