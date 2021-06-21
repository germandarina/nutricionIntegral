@extends('backend.layouts.app')

@section('title', app_name() . ' | Actualizar Información Personal')

@section('content')
{{ html()->modelForm($basic_information, 'PATCH', route('config.basic-information.update', $basic_information))->acceptsFiles()->class('form-horizontal')->open() }}
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
                                @include('backend.config.basic-information.partials.form')
                            </div>
                            <div class="tab-pane" id="phones-data" role="tabpanel">
                                @include('backend.config.basic-information.partials.phones')
                            </div>
                            <div class="tab-pane" id="recommendations-data" role="tabpanel">
                                @include('backend.config.basic-information.partials.recomendations')
                            </div>
                            <div class="tab-pane" id="color-data" role="tabpanel">
                                @include('backend.config.basic-information.partials.colors')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('config.basic-information.index'), __('buttons.general.cancel')) }}
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
            showFrequencyDays();

            $('#phones-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                dom: '',
                ajax: "{{ route('config.basic-information.getPhones',$basic_information->id) }}",
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
                ajax: "{{ route('config.basic-information.getRecommendations',$basic_information->id) }}",
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

            var template = '{{ $basic_information->template }}';
            if(template === '1')
            {
                $('#inline-minimalism').prop('checked',true);
            }
            else
            {
                $('#inline-full-data').prop('checked',true);
            }

            $(":radio").on('click',function ()
            {
               updateTemplate($(this));
            });
        });

        function showFrequencyDays()
        {
            var show = parseInt($("#show_frequency_days").val());
            if(show === 1)
            {
                $("#div_frenquency_days").show();
            }
            else
            {
                $("#div_frenquency_days").hide();
            }
        }

        function updateTemplate(radioButton)
        {
            var template;
            if(radioButton.attr('value') === 'full-data')
            {
                template = 2;
            }
            else
            {
                template = 1;
            }
            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});
            $(":radio").attr('disabled',true);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('config.basic-information.updateTemplate',$basic_information->id) }}',
                data:    {
                    'template': template,
                },
                type:     'PATCH',
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{ msg: datos.mensaje });
                    $(":radio").attr('disabled',false);
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }

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
                url:      '{{ route('config.basic-information.storePhone',$basic_information->id) }}',
                type:     'POST',
                data:    {
                    'code_area': code_area,
                    'phone'  : phone,
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{ msg: datos.mensaje });
                    $("#code_area").val("");
                    $("#phone").val("");
                    $('#phones-datatable').DataTable().ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
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

        function controlImage(event)
        {
            event.preventDefault();

            var name_file  = $('#recommendation_img')[0].files[0].name;
            var split_name = name_file.split('.');
            var extension  = split_name[split_name.length-1];

            if(extension !== 'jpg' && extension !== 'jpeg' && extension !== 'png') {
                $('#recommendation_img').val("");
                return Lobibox.notify('error',{msg: 'Debe seleccionar una imagen jpeg, jpg o png'})
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
                    url: "{{ route('config.basic-information.storeRecommendation',$basic_information->id) }}",
                    type: 'POST',
                    data: {
                        recommendation:recommendation
                    },
                    success: function(data) {
                        var datos = data;
                        procesando.remove();
                        Lobibox.notify('success',{ msg: datos.mensaje });
                        $("#recommendation_text").val("");
                        $('#recommendation-datatable').DataTable().ajax.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        procesando.remove();
                        if(xhr.status === 422){
                            Lobibox.notify('error',{msg: xhr.responseJSON.error});
                        }else{
                            Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                        }
                    }
                });
            }
            else
            {
                var fd    = new FormData();
                var files = $('#recommendation_img')[0].files;

                var name_file  = $('#recommendation_img')[0].files[0].name;
                var split_name = name_file.split('.');
                var extension  = split_name[split_name.length-1];

                if(extension !== 'jpg' && extension !== 'jpeg' && extension !== 'png')
                {
                    $('#recommendation_img').val("");
                    return Lobibox.notify('error',{msg: 'Debe seleccionar una imagen jpeg, jpg o png'})
                }

                if(files.length > 0 ){
                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    fd.append('recommendation_img',files[0]);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('config.basic-information.storeRecommendation',$basic_information->id) }}",
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
                            if(xhr.status === 422){
                                Lobibox.notify('error',{msg: xhr.responseJSON.error});
                            }else{
                                Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                            }
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
        color_day.style.background = '{{ $basic_information->color_days }}';
        var picker_day = new Picker({
            parent: color_day,
            color: '{{ $basic_information->color_days }}',
            popup: 'rigth',
        });

        picker_day.onChange = function(color) {
            color_day.style.background = color.rgbString;
            $("#value_day").val($("#color-day .picker_wrapper .picker_editor>input").val());
        };

        // COLOR HEADER
        var color_header = document.querySelector('#color-header');
        color_header.style.background     = '{{ $basic_information->color_headers }}';
        var picker_header = new Picker({
            parent: color_header,
            color: '{{ $basic_information->color_headers }}',
        });

        picker_header.onChange = function(color) {
            color_header.style.background = color.rgbString;
            $("#value_header").val($("#color-header .picker_wrapper .picker_editor>input").val());
        };

        // COLOR OBSERVATIONS
        var color_observations = document.querySelector('#color-observations');
        color_observations.style.background     = '{{ $basic_information->color_observations }}';
        var picker_observations = new Picker({
            parent: color_observations,
            color: '{{ $basic_information->color_observations }}',
        });

        picker_observations.onChange = function(color) {
            color_observations.style.background = color.rgbString;
            $("#value_observations").val($("#color-observations .picker_wrapper .picker_editor>input").val());
        };

        $(".div_color").tooltip();


        function storeColors(event)
        {
            event.preventDefault();
            var color_days           = $("#value_day").val();
            var color_headers        = $("#value_header").val();
            var color_observations  = $("#value_observations").val();

            if(color_days.trim() === '')
                return Lobibox.notify("error",{msg:"Seleccione el color del día"});

            if(color_headers.trim() === '')
                return Lobibox.notify("error",{msg:"Seleccione el color de la cabecera"});

            if(color_observations.trim() === '')
                return Lobibox.notify("error",{msg:"Seleccione el color de las observaciones"});

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:      '{{ route('config.basic-information.storeColors',$basic_information->id) }}',
                type:     'POST',
                data:    {
                    'color_days'          : color_days,
                    'color_headers'       : color_headers,
                    'color_observations' : color_observations
                },
                success: function(data) {
                    var datos = data;
                    procesando.remove();
                    Lobibox.notify('success',{ msg: datos.mensaje });
                    $("#download-plan").show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    if(xhr.status === 422){
                        Lobibox.notify('error',{msg: xhr.responseJSON.error});
                    }else{
                        Lobibox.notify('error',{msg: "Se produjo un error. Intentelo nuevamente"});
                    }
                }
            });
        }
    </script>
@endpush
