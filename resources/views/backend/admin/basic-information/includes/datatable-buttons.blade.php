@if(!$row->trashed())
    <div class="btn-group btn-group-sm" role="group" >
        <a title="Modificar" href='{{ route("admin.basic-information.edit",['id'=>$row->id]) }}' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
    </div>
@endif
