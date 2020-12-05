<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', app_name() )">
    <meta name="author" content="@yield('meta_author', 'Mandarina')">
    <link rel="shortcut icon" href="{{ asset('img/backend/diaita/diaita-logo.png') }}" />
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
    {{ style('lobibox/css/lobibox.css') }}
    {{ style('select2/select2.min.css') }}
    {{ style('datepicker/bootstrap-datepicker.min.css') }}

    @stack('after-styles')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.logged-in-as')
{{--            @if(Breadcrumbs::exists())--}}
{{--                {!! Breadcrumbs::render() !!}--}}
{{--            @endif--}}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
        @include('backend.modal-confirm')
        @yield('modal-yield')
    </div><!--app-body-->
    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}

    {{ script('lobibox/js/lobibox.js') }}
    {{ script('inputmask/inputmask.js')}}
    {{ script('inputmask/jquery.inputmask.js')}}
    {{ script('inputmask/inputmask.numeric.extensions.js')}}
    {{ script('datepicker/bootstrap-datepicker.min.js') }}
    {{ script('datepicker/bootstrap-datepicker.es.min.js') }}

    @include('backend.notification')

    <script type="text/javascript">
        $(function () {
            $('select').select2({
                minimumResultsForSearch: 5,
                width: '100%',
            });
        });

        function eliminarItem(e,input){
            e.preventDefault();
            var url = input.data('url');
            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText : 'No',
            }).then((result) => {
                if (result.value) {
                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      url,
                        type:     'POST',
                        data: {_method: 'POST'},
                        success: (function (data){
                            procesando.remove();
                            Lobibox.notify("success",{msg: data.mensaje,'position': 'top right','title':'Éxito'});
                        }),
                        error: (function (jqXHR, exception) {
                            procesando.remove();

                            if (jqXHR.status === 422){
                                let mensaje = jqXHR.responseJSON.error
                                Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                            }
                        }),
                        complete:(function (data) {
                            $('#confirm').modal('hide');
                            $('.data-table').DataTable().draw(false);
                        })
                    });
                }
            });
        }

        function restaurarItem(e,input){
            e.preventDefault();
            var url = input.data('url');
            Swal.fire({
                title: 'Esta seguro de realizar esta accion?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Restaurar',
                cancelButtonText : 'No',
            }).then((result) => {
                if (result.value) {
                    procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:      url,
                        type:     'POST',
                        data: {_method: 'POST'},
                        success: (function (data){
                            procesando.remove();
                            Lobibox.notify("success",{msg: data.mensaje,'position': 'top right','title':'Éxito'});
                        }),
                        error: (function (jqXHR, exception) {
                            procesando.remove();
                            if (jqXHR.status === 422){
                                let mensaje = jqXHR.responseJSON.error
                                Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
                            }
                        }),
                        complete:(function (data) {
                            $('#confirm').modal('hide');
                            $('.data-table').DataTable().draw(false);
                        })
                    });
                }
            });
        }


        var notifyOptions = {
            'sound': false,
            'icon': false,
            'iconSource': false,
            'position': 'top right',
            'size': 'mini',
            'iconClass': false,
        };

        Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, notifyOptions);

        //Esta funcion deshabilita el enter en para hacer un submit del formulario
        $(document).on("keypress", "form", function(event) {
            return event.keyCode !== 13;
        });

        var currencyOptions = {
            'alias': 'numeric',
            'groupSeparator': '.',
            'radixPoint': ',',
            'autoGroup': true,
            'digits': 2,
            'digitsOptional': false,
            'prefix': '',
            'placeholder': '0',
            'removeMaskOnSubmit': true,
            'unmaskAsNumber': true,
            'clearMaskOnLostFocus': false,
            'negationSymbol': {
                front: '',
                back: ''
            },
        };

        var currency3DecimalOptions = {
            'alias': 'numeric',
            'groupSeparator': '.',
            'radixPoint': ',',
            'autoGroup': true,
            'digits': 3,
            'digitsOptional': false,
            'prefix': '',
            'placeholder': '0',
            'removeMaskOnSubmit': true,
            'unmaskAsNumber': true,
            'clearMaskOnLostFocus': false,
            'negationSymbol': {
                front: '',
                back: ''
            },
        };

        // var currencyInteger = {
        //     'alias': 'numeric',
        //     'groupSeparator': '.',
        //     'radixPoint': ',',
        //     'autoGroup': true,
        //     'digits': 0,
        //     'digitsOptional': false,
        //     'prefix': '',
        //     'placeholder': '0',
        //     'removeMaskOnSubmit': true,
        //     'unmaskAsNumber': true,
        //     'clearMaskOnLostFocus': false
        // };

        // var percentOptions = {
        //     'alias': 'numeric',
        //     'groupSeparator': '.',
        //     'radixPoint': ',',
        //     'autoGroup': true,
        //     'digits': 0,
        //     'suffix': ' %',
        //     'digitsOptional': false,
        //     'prefix':'',
        //     'placeholder': '0',
        //     'removeMaskOnSubmit': true,
        //     'unmaskAsNumber': true,
        //     'clearMaskOnLostFocus': false
        // };

        // var percentDecimalOptions = {
        //     'alias': 'numeric',
        //     'groupSeparator': '.',
        //     'radixPoint': ',',
        //     'autoGroup': true,
        //     'digits': 2,
        //     'digitsOptional': false,
        //     'prefix': '',
        //     'suffix': ' %',
        //     'placeholder': '0',
        //     'removeMaskOnSubmit': true,
        //     'unmaskAsNumber': true,
        //     'clearMaskOnLostFocus': false
        // };

        //$('.numericOptions').inputmask(currencyOptions);
        //$('.numericInteger').inputmask(currencyInteger);
        $('.numeric3Digits').inputmask(currency3DecimalOptions);
        $('.numericDigits').inputmask(currencyOptions);

        //$(".cuit").inputmask("99-99999999-9");
        //$('.percentOptions').inputmask(percentOptions);
        //$('.percentDecimalOptions').inputmask(percentDecimalOptions);
        $('.select2 .select2-container .select2-container--default').css('width', '100%');
        $("span.select2.select2-container.select2-container--default").css("width","100%");
        $(".form-control-label").css('font-size','12px').css('padding','1');
    </script>

    @stack('after-scripts')
    {{ script('select2/select2.min.js')}}
    {{ script('vendor/jsvalidation/js/jsvalidation.js') }}
    {{ script('loading/loadingoverlay.min.js') }}

</body>
</html>
