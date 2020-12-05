<div class="row">
    {{ html()->label('Desc. Actividad')
               ->class('col-md-2 form-control-label offset-1')
               ->for('description') }}
    <div class="col-md-8">
        {{ html()->text('description')
            ->class('form-control')
            ->placeholder('Descripcion')
            ->required()
            }}
    </div><!--col-->
</div>
<div class="row">
    {{ html()->label('Actividad')
               ->class('col-md-2 form-control-label offset-1')
               ->for('activity_fao') }}
    <div class="col-md-8">
        {{ html()->select('activity_fao',\App\Models\PlanEnergySpending::$activities_fao_oms)
            ->class('form-control')
            ->placeholder('Seleccione...')
            ->attribute("id","activity_fao")
            ->attributes(['onchange'=>'setActivityValue(event)'])
            ->required()
            }}
    </div><!--col-->
</div>
<div class="row mt-4">
    {{ html()->label('Factor de Act.')
                ->class('col-md-2 form-control-label offset-1')
                ->for('factor_activity') }}
    <div class="col-md-8">
        {{ html()->text('factor_activity')
            ->class('form-control numericDigits')
            ->autofocus() }}
    </div><!--col-->
</div>

<div class="row mt-4">
    {{ html()->label('TMB')
                ->class('col-md-2 form-control-label offset-1')
                ->for('tmb') }}
    <div class="col-md-8">
        {{ html()->text('tmb')
            ->class('form-control numericDigits')
            ->attribute('readonly',true)
            ->autofocus() }}
    </div><!--col-->
</div>

<div class="row mt-4">
    {{ html()->label('Horas')
                ->class('col-md-2 form-control-label offset-1')
                ->for('hours') }}
    <div class="col-md-8">
        {{ html()->text('hours')
            ->class('form-control numericDigits')
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div>
<div class="row mt-4">
    {{ html()->label('Días por Semana')
                ->class('col-md-2 form-control-label offset-1')
                ->for('days') }}
    <div class="col-md-8">
        {{ html()->input('number','days')
            ->class('form-control')
            ->attributes(['onchange'=>'calculateAverageAndTotal(event)'])
            ->autofocus() }}
    </div><!--col-->
</div>
<div class="row mt-4">
    {{ html()->label('Promedio de Act.')
                ->class('col-md-2 form-control-label offset-1')
                ->for('weekly_average_activity') }}
    <div class="col-md-8">
        {{ html()->text('weekly_average_activity')
            ->class('form-control numericDigits')
            ->value(0)
            ->attribute('readonly',true)
            ->autofocus() }}
    </div><!--col-->
</div>

<div class="row mt-4">
    {{ html()->label('Total')
                ->class('col-md-2 form-control-label offset-1')
                ->for('total') }}
    <div class="col-md-8">
        {{ html()->text('total')
            ->class('form-control numericDigits')
            ->attribute('readonly',true)
            ->autofocus() }}
    </div><!--col-->
</div>
