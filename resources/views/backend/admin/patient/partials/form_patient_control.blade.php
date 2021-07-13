<div class="row">
    {{ html()->label('Periodo')
                ->class('col-sm-2 col-offset-1 form-control-label')
                ->for('period')
                }}
    <div class="col-md-9">
        {{ html()->text('period')
            ->class('form-control')
            ->placeholder('Periodo')
            ->attribute("id","period")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('Talla (cm)')
                ->class('col-sm-2 form-control-label')
                ->for('height') }}
    <div class="col-md-9">
        {{ html()->text('height')
            ->value(0)
            ->class('form-control numericDigits')
            ->placeholder('Talla  del paciente')
            ->attribute("id","height")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('Peso (kg)')
                ->class('col-sm-2 form-control-label')
                ->for('weight') }}
    <div class="col-md-9">
        {{ html()->text('weight')
            ->value(0)
            ->class('form-control numericDigits')
            ->placeholder('Peso del paciente')
            ->attribute("id","weight")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('Cintura (cm)')
                ->class('col-sm-2 form-control-label')
                ->for('waist') }}
    <div class="col-md-9">
        {{ html()->text('waist')
            ->value(0)
            ->class('form-control numericDigits')
            ->placeholder('Cintura del paciente')
            ->attribute("id","waist")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('Cadera (cm)')
                ->class('col-sm-2 form-control-label')
                ->for('hips') }}
    <div class="col-md-9">
        {{ html()->text('hips')
            ->value(0)
            ->class('form-control numericDigits')
            ->placeholder('Cadera del paciente')
            ->attribute("id","hips")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('Kg Músculo')
                ->class('col-sm-2 form-control-label')
                ->for('muscle_kg') }}
    <div class="col-md-9">
        {{ html()->text('muscle_kg')
            ->value(0)
            ->class('form-control numericDigits')
            ->placeholder('Kg Músculo')
            ->attribute("id","muscle_kg")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('Kg Grasa')
                ->class('col-sm-2 form-control-label')
                ->for('fat_kg') }}
    <div class="col-md-9">
        {{ html()->text('fat_kg')
            ->value(0)
            ->class('form-control numericDigits')
            ->placeholder('Kg Grasa')
            ->attribute("id","fat_kg")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('% Músculo')
                ->class('col-sm-2 form-control-label')
                ->for('muscle_percent') }}
    <div class="col-md-9">
        {{ html()->text('muscle_percent')
            ->value(0)
            ->class('form-control percentDigits')
            ->placeholder('Porcentaje Músculo')
            ->attribute("id","muscle_percent")
        }}
    </div><!--col-->
</div>

<div class="row mt-2">
    {{ html()->label('% Grasa')
                ->class('col-sm-2 form-control-label')
                ->for('fat_percent') }}
    <div class="col-md-9">
        {{ html()->text('fat_percent')
            ->value(0)
            ->class('form-control percentDigits')
            ->placeholder('Porcentaje de grasa')
            ->attribute("id","fat_percent")
        }}
    </div><!--col-->
</div>
<input type="hidden" name="control_id" id="control_id">
