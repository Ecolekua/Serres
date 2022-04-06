<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <!-- <?php
        phpinfo();
        ?> -->
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links btn btn-primary btn-lg">
                    @auth
                        @if (auth()->User()->Tipo=="cliente");
                            <a class="text-light" href="{{ route('homeCliente') }}">Sesión ya Iniciada, Regresar al Sitio</a>
                        @else
                        <a class="text-light" href="{{ route('home') }}">Sesión ya Iniciada, Regresar al Sitio</a>
                        @endif
                    @else
                        <a class="text-light" href="{{ route('login') }}">Login</a>
                        <!-- <a href="{{ route('register') }}">Register</a> -->
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    SerresVerificadora SpA
                </div>

                <div class="links">
                    <a href="">Soporte</a>
                    <a href="https://www.serres.cl">Serres.cl</a>
                    <!-- <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> -->
                </div>
               <br>
               <br>
                <div class="card text-center card border-info mb-3 shadow p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        <strong><h3>¡¡ Atención !!</h3></strong>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">En caso de presentar problemas de inicio de sesión,</h5>
                        <p class="card-text">favor tomar contacto con su ejecutivo asignado.</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                    <div class="card-footer text-muted">
                    Serres Verificadora SpA
                    </div>
                </div>
                  
                <span>Serres Verificadora Limitada / Diagonal Cervantes N°683 oficina 207, Santiago / Fono +(56-2) 226386843  +(56 2) 226328933 <br /> Horario de atención: Lunes a Jueves de 09:00 a 18:00 hrs y Viernes de 09:00 a 15:00 hrs.<br />
                        E-mail: contacto@serres.cl</span>x




            </div>
        </div>


         


    </body>
</html>
