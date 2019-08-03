<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ style(mix('css/backend.css')) }}
    {{ style('css/animate.min.css') }}
    {{ style('css/login.css') }}
    <title>Renasser - Login</title>
    <style>
        body {
            background-image:url('img/fondo.jpg');
            background-color: #FFFFFF;
        }
        .login-sidebar:after {
            background: linear-gradient(-135deg,white,white);
            background: -webkit-linear-gradient(-135deg,white,whitesmoke);
        }
        .login-button, .bar:before, .bar:after{
            background:#dd4b39;
        }
        .signin{
            font-size: 14px;
        }
    </style>

    <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg animated"></div>
        <div class="hidden-xs col-sm-8 col-md-9">
            <div class="clearfix">
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <div class="logo-title-container">
                        <div class="copy animated fadeIn">
                            <h1>Renasser</h1>
                            <p>Administración</p>
                        </div>
                    </div> <!-- .logo-title-container -->
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-3 login-sidebar animated fadeInRightBig">

            <div class="login-container animated fadeInRightBig">

                <h2>Inicio de Sesión</h2>
                {{ html()->form('POST', route('frontend.auth.login.post'))->class('form-horizontal')->open() }}
                 {{ csrf_field() }}
                <div class="form-group row">
                        {{ html()->email('email')
                                   ->class('form-control')
                                   ->placeholder('Email')
                                   ->attribute('maxlength', 191)
                                   ->required()
                                   ->autofocus() }}
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>

                <div class="form-group row">
                        {{ html()->password('password')
                       ->class('form-control')
                       ->placeholder('Contraseña')
                       ->attribute('maxlength', 191)
                       ->required()
                       ->autofocus() }}
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>

                    <button type="submit" class="btn btn-block login-button">
                        <span class="signingin hidden"><span class="glyphicon glyphicon-refresh">
                        <span class="signin">Acceder</span>
                    </button>

                {{ html()->form()->close() }}

                @if(!$errors->isEmpty())
                    <div class="alert alert-black">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div> <!-- .login-container -->

        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->

    @yield('before-scripts')
    {!! script(mix('js/frontend.js')) !!}
    @yield('after-scripts')

    @include('includes.partials.ga')

</div> <!-- .container-fluid -->
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
</script>
</body>
</html>