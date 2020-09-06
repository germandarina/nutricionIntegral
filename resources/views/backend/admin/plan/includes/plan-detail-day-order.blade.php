@if(!$row->trashed())
    <input min="1" max="12" style="width: 40px;" type="number" id="order_{{$day}}_{{$row->id}}" @if($row->order > 0) value="{{ $row->order }}" @endif>
@endif
