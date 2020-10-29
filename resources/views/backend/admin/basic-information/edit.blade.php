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

            <div class="row">
                <div class="col-md-12 mb-12">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home">Datos Personales</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Teléfonos de Contacto</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-2" role="tab" aria-controls="profile">Recomendaciones Para Planes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel">
                                @include('backend.admin.basic-information.partials.form')
                            </div>
                            <div class="tab-pane" id="profile-1" role="tabpanel">
                                @include('backend.admin.basic-information.partials.phones')
                            </div>
                            <div class="tab-pane" id="profile-2" role="tabpanel">
                                @include('backend.admin.basic-information.partials.recomendations')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.basic-information.index'), __('buttons.general.cancel')) }}
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
            $('.phones-datatable').DataTable({
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

            showRecommendationByType();
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

        function showRecommendationByType()
        {
            var type = $("#type").val();
            if(type === '0')
            {
                $("#divTxt").show();
                $("#recommendation_img").val("");
                $("#divImg").hide();
            }
            else
            {
                $("#divTxt").hide();
                $("#recommendation_text").val("");
                $("#divImg").show();
            }
        }
    </script>
@endpush
