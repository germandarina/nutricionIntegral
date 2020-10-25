@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Información Personal')

@section('content')
{{ html()->modelForm($basic_information, 'PATCH', route('admin.basic-information.update', $basic_information))->acceptsFiles()->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Actualizar Información Personal</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.admin.basic-information.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.basic-information.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
    {!! $validator !!}

    @include('datatables.includes')
    <script>
        $(function () {
            $('.data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                dom: '',
                ajax: "{{ route('admin.basic-information.getPhones',$basic_information->id) }}",
                columns: [
                    {data: 'code_area', name: 'code_area',width:'30%'},
                    {data: 'phone', name: 'phone',width:'30%'},
                    {data: 'actions', name: 'actions'},
                ]
            });
        });

        function storePhone(event)
        {
            event.preventDefault();
            var code_area = $("#code_area").val();
            var phone     = $("#phone").val();

            if(code_area.trim() === '')
            {
               return Lobibox.notify("error",{msg:"Ingrese el código de área"});
            }

            if(phone.trim() === '')
            {
                return Lobibox.notify("error",{msg:"Ingrese el télefono"});
            }

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('admin.basic-information.storePhone',$basic_information->id) }}',
                type:     'POST',
                data:    {
                    'code_area': code_area,
                    'phone'  : phone,
                },
                success: function(data) {
                    var datos = data;
                    Lobibox.notify('success',{ msg: datos.mensaje });
                    procesando.remove();
                    $("#code_area").val("");
                    $("#phone").val("");
                    $('.data-table').DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush
