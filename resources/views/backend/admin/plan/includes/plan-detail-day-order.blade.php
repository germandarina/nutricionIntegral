@if(!$row->trashed())
    <input min="0" max="12" style="width: 40px;" type="number" id="order_{{$row->id}}" @if($row->order > 0) value="{{ $row->order }}" @endif>
{{--        <a onclick="storeOrder(event,{{ $row->id }},{{$day}})" title="Guardar Orden" href="" class="btn btn-sm btn-success ml-2">--}}
{{--            <i class="fas fa-check-circle"></i>--}}
{{--        </a>--}}
@endif
