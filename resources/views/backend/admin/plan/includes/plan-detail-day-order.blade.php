@if(!$row->trashed())
    <input min="1" max="20" style="width: 40px;" type="number" id="order_{{$day}}_{{$row->id}}" @if($row->order > 0) value="{{ $row->order }}" @endif>
    {{ html()->select('order_type',\App\Models\PlanDetail::$types,$row->order_type)
            ->placeholder('Seleccione...')
            ->attribute('id',"order-type_{$day}_{$row->id}")
        }}
@endif
