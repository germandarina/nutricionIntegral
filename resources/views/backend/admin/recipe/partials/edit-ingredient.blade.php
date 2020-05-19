<div>
    <div class="row">
        {{ html()->label('Alimento')
                   ->class('col-md-2 form-control-label')
                   ->for('edit_food_id') }}
        <div class="col-md-8">
            {{ html()->select('edit_food_id',[])
                ->class('form-control')
                ->placeholder('Buscar alimento...')
                ->attribute("id","edit_food_id")
                ->attributes(['onchange'=>'getComposicionBasica()'])
                ->required()
                }}
        </div><!--col-->
    </div>
    <br>
    <div id="divComposicion">

    </div>
    <div class="row">
        {{ html()->label('Cant.(Desc.)')
                    ->class('col-md-2 form-control-label')
                    ->for('quantity_description') }}
        <div class="col-md-3">
            {{ html()->text('quantity_description')
                ->class('form-control')
                ->placeholder('1/2 taza, 1 cucharada, etc')
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
        </div><!--col-->

        {{ html()->label('Cant. (Grs)')
                    ->class('col-md-2 form-control-label')
                    ->for('quantity_grs') }}
        <div class="col-md-3">
            {{ html()->text('quantity_grs')
                ->class('form-control')
                ->placeholder('100, 80, etc.')
                ->value(0)
                ->autofocus() }}
        </div><!--col-->
        <div class="col-md-2">
            <a href="#" class="btn btn-sm- btn-success"><i class="fas fa-save"></i></a>
        </div>
    </div>
</div>

