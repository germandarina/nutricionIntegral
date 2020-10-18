@if(!$row->trashed())

    <input min="1" max="20" style="width: 40px;" type="number" id="order_{{$day}}_{{$row->id}}" @if($row->order > 0) value="{{ $row->order }}" @endif @if (!$plan->open) readonly @endif>

    @if ($plan->open)
        {{ html()->select('order_type',\App\Models\PlanDetail::$types,$row->order_type)
            ->placeholder('Seleccione...')
            ->attribute('id',"order-type_{$day}_{$row->id}")
        }}
    @else
        <input style="width: 80px;"  value="{{ \App\Models\PlanDetail::$types[$row->order_type] }}"  readonly >
    @endif

@endif
