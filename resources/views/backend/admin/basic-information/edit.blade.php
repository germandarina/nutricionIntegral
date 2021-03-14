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
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#data" role="tab" aria-controls="home">Datos Personales</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#phones-data" role="tab" aria-controls="profile">Teléfonos de Contacto</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recommendations-data" role="tab" aria-controls="profile">Recomendaciones Para Planes</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#color-data" role="tab" aria-controls="profile">Personaliza tus Planes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="data" role="tabpanel">
                                @include('backend.admin.basic-information.partials.form')
                            </div>
                            <div class="tab-pane" id="phones-data" role="tabpanel">
                                @include('backend.admin.basic-information.partials.phones')
                            </div>
                            <div class="tab-pane" id="recommendations-data" role="tabpanel">
                                @include('backend.admin.basic-information.partials.recomendations')
                            </div>
                            <div class="tab-pane" id="color-data" role="tabpanel">
                                @include('backend.admin.basic-information.partials.colors')
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
{{--<style>--}}
{{--    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Fjalla+One&family=Merriweather:wght@700&display=swap');--}}
{{--</style>--}}

@push('after-scripts')

    {{ script('vanilla-picker/vanilla-picker.min.js')  }}

    {!! $validator !!}

    @include('datatables.includes')
    <script>
        $(function () {

            $('#phones-datatable').DataTable({
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

            $('#recommendation-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                dom: '',
                ajax: "{{ route('admin.basic-information.getRecommendations',$basic_information->id) }}",
                columns: [
                    {data: 'type', name: 'type',width:'30%'},
                    {data: 'recommendation', name: 'recommendation',width:'30%'},
                    {data: 'actions', name: 'actions'},
                ]
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
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
                    $('#phones-datatable').DataTable().ajax.reload();
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

        function storeRecommendation(event)
        {
            event.preventDefault();
            var type = $("#type").val();

            if(type === '0')
            {
                var recommendation = $("#recommendation_text").val();

                if(recommendation.trim() === '')
                {
                    return Lobibox.notify("error",{msg:"Ingrese la recomendación"});
                }

                procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.basic-information.storeRecommendation',$basic_information->id) }}",
                    type: 'POST',
                    data: {
                        recommendation:recommendation
                    },
                    success: function(data) {
                        var datos = data;
                        Lobibox.notify('success',{ msg: datos.mensaje });
                        $("#recommendation_text").val("");
                        $('#recommendation-datatable').DataTable().ajax.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        procesando.remove();
                        Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                    }
                });
            }
            else
            {
                var fd = new FormData();
                var files = $('#recommendation_img')[0].files;
                if(files.length > 0 ){
                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    fd.append('recommendation_img',files[0]);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.basic-information.storeRecommendation',$basic_information->id) }}",
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            var datos = data;
                            Lobibox.notify('success',{ msg: datos.mensaje });
                            $("#recommendation_img").val("");
                            $('#recommendation-datatable').DataTable().ajax.reload();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            procesando.remove();
                            Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                        }
                    });
                }
                else
                {
                    return Lobibox.notify('error',{msg:'Cargue una imagen'});
                }
            }
        }

        // COLOR DAY
        var color_day = document.querySelector('#color-day');
        var picker_day = new Picker({
            parent: color_day,
            color: 'green',
        });

        picker_day.onChange = function(color) {
            color_day.style.background = color.rgbaString;
            $("#value_day").val($(".picker_editor>input").val());
        };

        // COLOR HEADER
        var color_header = document.querySelector('#color-header');
        var picker_header = new Picker({
            parent: color_header,
            color: 'green',
        });

        picker_header.onChange = function(color) {
            color_header.style.background = color.rgbaString;
            $("#value_header").val($(".picker_editor>input").val());
        };

        // COLOR OBSERVATIONS
        var color_observations = document.querySelector('#color-observations');
        var picker_observations = new Picker({
            parent: color_observations,
            color: 'green',
        });

        picker_observations.onChange = function(color) {
            color_observations.style.background = color.rgbaString;
            $("#value_observations").val($(".picker_editor>input").val());
        };

        $(".div_color").tooltip();
    </script>
@endpush
