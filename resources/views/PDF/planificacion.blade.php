<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
    body {
        margin: 2cm, 0cm, 0cm;
    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: white;
        color: gray;

        line-height: 30px;
    }

    ima {
        height: 100px;
        width: 50px;
    }
</style>

<body>
    <div class="ima">

    </div>


    <header>
        <div class="row">
           <!--  <img src="{{asset('assets/media/Escuela/escuela-espana-228x300.png')}}"> -->
            <center>
                <h6>Escuela Diferencial E-1197 Chile – España, Concepción<br>
                    Avenida Pedro de Valdivia 651, Concepción, fono fax 2331204<br>
                    e-mail: e.chileespana@educacionpublica.cl</h6>
            </center>
        </div>
    </header>
    <div class="container">
        <?php $datos[0]->fecha_cambio = \Carbon\Carbon::parse($datos[0]->fecha_cambio)->format('d-m-Y'); ?>
        <center><b><u>Planificación {{$datos[0]->fecha_cambio}}</u></b></center>

        <br>
        <b>I. IDENTIFICACIÓN</b>
        <table class="table table-bordered table-condensed">
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <td>{{$usuario->nombre}} {{$usuario->apellido_p}} {{$usuario->apellido_m}}</td>
                </tr>
                <tr>
                    <th>Curso / Nivel</th>
                    <td>{{$curso->curso}}</td>
                </tr>
                <tr>
                    <th>Profesor(a)</th>
                    <td>{{$jefe->nombre}} {{$jefe->apellido_p}} {{$jefe->apellido_m}}</td>
                </tr>
                <tr>
                    <th>Co-educadora</th>
                    <td>{{$ayudante->nombre}} {{$ayudante->apellido_p}} {{$ayudante->apellido_m}}</td>
                </tr>
                <tr>
                    <th>Tiempo duración</th>
                    <td>Bimensual</td>

                </tr>
            </tbody>
        </table>
        <br>
        <br>
        @foreach($datos as $item)
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Asignatura: {{$item->materia}}</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="width: 50%;"><b>Objetivo currículum:</b> <br>{{$item->objetivo}} </td>
                    <td><b>Adecuación Curricular:</b><br>{{$item->adecuacion}}</td>
                </tr>
                <tr>
                    <td style="width: 50%;"><b>Habilidades:</b> <br>{{$item->habilidades}} </td>
                    <td><b>Indicadores de Evaluación:</b><br>{{$item->indicador}}</td>
                </tr>

            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 100%;"><b>Metodología:</b> <br>{{$item->metodologia}}</td>
                </tr>
                <tr>
                    <td style="width: 100%;"><b>Desarrollo Personal:</b> <br>{{$item->personal}}</td>
                </tr>
                <tr>
                    <td style="width: 100%;"><b>Inclusión Social:</b> <br>{{$item->social}}</td>
                </tr>

            </tbody>
        </table>


        @endforeach
    </div>
</body>

</html>