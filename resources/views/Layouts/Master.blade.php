<!DOCTYPE html>
<html>

<head>
    <title>@yield('Titulo')</title>
    @yield('Importaciones')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--Toast para mostrar notificaciones -->
    <script type="text/javascript" src="{{ URL::to('js/toastr.js') }}"></script>
    <link type="text/css" href="css/toastr.css" rel="stylesheet" />
    <link type="text/css" href="css/principal.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::to('js/load.js') }}"></script>   
</head>
<link rel="shortcut icon" href="img/logo.png">
<header>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img src="img/ujed.png" alt="Responsive image" id="ujed" class="img-fluid">
                    </div>
                    <div class="col-sm">
                        <h1> Sistema Bibliotecario</h1>
                    </div>
                    <div class="col-sm">
                        <img src="img/feca.jpg" alt="Responsive image" id="feca" class="img-fluid">

                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('Body')
    @yield('ImportacionesF')

</html>
