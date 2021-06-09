<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Practica Layouts Bootstrap</title>
        <link
            rel="stylesheet"
            href="{{ asset('bootstrap/css/bootstrap.min.css') }}"
        />
        <link
        rel="stylesheet"
        href="{{ asset('estilos.css') }}"
    />
    </head>

    <body>
        <div class="cointainer">
            <div class="row">
                <div class="col columnas fila1a d-none d-lg-block">A</div>
            </div>
            <div class="row">
                <div class="col columnas fila1b d-lg-none">L</div>
            </div>
            <div class="row">
                <div class="col columnas fila2 d-none d-md-block">B</div>
                <div class="col columnas fila2">C</div>
                <div class="col columnas fila2">D</div>
                <div class="col columnas fila2 d-none d-lg-block">E</div>
            </div>
            <div class="row">
                <div class="col columnas fila3 col-12 col-md-6">F</div>
                <div class="col columnas fila3 d-none d-md-block col-md-6">G</div>
                <div class="col columnas fila3 d-md-none">M</div>
            </div>
            <div class="row">
                <div class="col columnas fila4 col-12 col-lg-9">H</div>
                <div class="col columnas fila4">I</div>
            </div>
            <div class="row">
                <div class="col columnas fila5 col-12 col-lg-5">J</div>
                <div class="col columnas fila5 d-none d-md-block col-lg-5">K</div>
            </div>
        </div>

        <script src="{{
                asset('bootstrap/js/bootstrap.bundle.min.js')
            }}"></script>
    </body>
</html>
