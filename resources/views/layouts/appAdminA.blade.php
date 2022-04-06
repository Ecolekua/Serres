<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="{{ asset('js/funciones.js') }}"></script>

    <script src="{{ asset('js/FuncionesSweetAlert.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> 
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   
   <!-- swal desde las funciones de sweet alert 2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.9.0/dist/sweetalert2.all.min.js"></script>
    <!-- fin desde las funciones -->

   <!-- para sweet alert desde el contralador -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
   <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

<!-- activación de botones de las tablas -->
                    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script> -->





</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sisgedo
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @can('administradorMenu.index')
                    <div class="dropdown">
                        <button class="mr-2 btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administración
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @can('users.index')
                                <a class="dropdown-item" href="{{ route('users.index') }}">Usuarios</a>
                            @endcan  
                            @can('roles.index')  
                                <a class="dropdown-item" href="{{ route('roles.index') }}">Roles de Usuarios</a>
                            @endcan  
                            @can('rolesprofiles.index')    
                                <a class="dropdown-item" href="{{ route('rolesprofiles.index') }}">Roles y Perfiles</a>
                            @endcan  
                            @can('empresas.index')    
                                <a class="dropdown-item" href="{{ route('empresas.index') }}">Empresas</a>
                            @endcan
                            @can('Proyectos.index')    
                                <a class="dropdown-item" href="{{ route('proyectos.index') }}">Proyectos de Mandantes</a>
                            @endcan
                            <!-- @can('formularios.index')    
                                <a class="dropdown-item" href="{{ route('formularios.index') }}">Formularios</a>
                            @endcan -->
                            @can('estructuras.index')    
                                <a class="dropdown-item" href="{{ route('estructuras.index') }}">Asignación Contratistas a Proyectos </a>
                            @endcan
                            @can('usucontform.index')    
                                <a class="dropdown-item" href="{{ route('usuconforms.index') }}">Asignar usuarios y formulario a contratista</a>
                            @endcan
                            @can('admsol.index')    
                                <a class="dropdown-item" href="{{ route('admsol.index') }}">Administrar Solicitudes</a>
                            @endcan
                            @can('admsol.index')    
                                <a class="dropdown-item" href="{{ route('admsolAprobadas.index') }}">Administrar Solicitudes Aprobadas x Inspectores</a>
                            @endcan
                            @can('admsol.index')    
                                <a class="dropdown-item" href="{{ route('admsolAprobadasLiberadas.index') }}">Solicitudes Aprobadas y Liberadas a Clientes</a>
                            @endcan
                            @can('admsol.index')    
                                <a class="dropdown-item" href="{{ route('cargaMasivaUsuario.carga') }}">Carga Masiva de Usuarios</a>
                            @endcan
                            @can('admsol.index')    
                                <a class="dropdown-item" href="{{ route('cargaMasivaEmpresas.carga') }}">Carga Masiva de Empresas</a>
                            @endcan
                            
                        </div>
                    </div>
                    @endcan 
                    @can('SolicitudesFinalizadas.crud')
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Inspector
                        </button>
                    @endcan  
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @can('SolicitudesFinalizadas.crud')
                                <a class="dropdown-item" href="{{ route('SolicitudesInspector.index') }}">Solicitudes Nuevas</a>
                            @endcan 
                            @can('SolicitudesFinalizadas.crud')
                                <a class="dropdown-item" href="{{ route('SolicitudesFinalizadas.index') }}">Solicitudes Finalizadas</a>
                            @endcan   
                            
                        </div>
                    </div>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('sweet::alert')
    <script src="{{ asset('js/funciones.js') }}"></script>  
</body>
</html>
