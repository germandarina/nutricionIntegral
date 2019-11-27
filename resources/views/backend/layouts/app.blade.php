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
    <meta name="description" content="@yield('meta_description', 'Nutricion Integral')">
    <meta name="author" content="@yield('meta_author', 'Mandarina')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
    {{ style('lobibox/css/lobibox.css') }}
    {{ style('select2/select2.min.css') }}
    {{ style('kartik-fileinput/fileinput.min.css') }}

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
            @if(Breadcrumbs::exists())
                {!! Breadcrumbs::render() !!}
            @endif

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

    @include('backend.notification')

    <script type="text/javascript">
        $(function () {
            $('select').select2({
                minimumResultsForSearch: 5,
                width: '100%',
            });
        });

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
            return event.keyCode != 13;
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
            'clearMaskOnLostFocus': false
        };

        var currencyInteger = {
            'alias': 'numeric',
            'groupSeparator': '.',
            'radixPoint': ',',
            'autoGroup': true,
            'digits': 0,
            'digitsOptional': false,
            'prefix': '',
            'placeholder': '0',
            'removeMaskOnSubmit': true,
            'unmaskAsNumber': true,
            'clearMaskOnLostFocus': false
        };

        var percentOptions = {
            'alias': 'numeric',
            'groupSeparator': '.',
            'radixPoint': ',',
            'autoGroup': true,
            'digits': 0,
            'suffix': ' %',
            'digitsOptional': false,
            'prefix':'',
            'placeholder': '0',
            'removeMaskOnSubmit': true,
            'unmaskAsNumber': true,
            'clearMaskOnLostFocus': false
        };

        var percentDecimalOptions = {
            'alias': 'numeric',
            'groupSeparator': '.',
            'radixPoint': ',',
            'autoGroup': true,
            'digits': 2,
            'digitsOptional': false,
            'prefix': '',
            'suffix': ' %',
            'placeholder': '0',
            'removeMaskOnSubmit': true,
            'unmaskAsNumber': true,
            'clearMaskOnLostFocus': false
        };

        $('.numericOptions').inputmask(currencyOptions);
        $('.numericInteger').inputmask(currencyInteger);
        $(".cuit").inputmask("99-99999999-9");
        $('.percentOptions').inputmask(percentOptions);
        $('.percentDecimalOptions').inputmask(percentDecimalOptions);
        $('.select2 .select2-container .select2-container--default').css('width', '100% !important');
    </script>

    @stack('after-scripts')
    {{ script('select2/select2.min.js')}}
    {{ script('kartik-fileinput/piexif.min.js')}}
    {{ script('kartik-fileinput/sortable.min.js')}}
    {{ script('kartik-fileinput/purify.min.js')}}
    {{ script("datatables/popper.min.js") }}
    {{ script('kartik-fileinput/fileinput.min.js')}}
    {{ script('kartik-fileinput/theme-fontawesome5.js') }}
    {{ script('vendor/jsvalidation/js/jsvalidation.js') }}
{{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>--}}

</body>
</html>
