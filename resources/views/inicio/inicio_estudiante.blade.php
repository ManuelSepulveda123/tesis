@extends('layout.layout')

@section('titulo')
Escuela Chile España | Inicio
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Inicio
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                Estudiante
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">


        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{$curso->curso}}
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <iframe  src="https://www.youtube.com/embed/KbNL9ZyB49c" allowfullscreen></iframe>
                </div>
                <div class="col-xl-6 col-lg-6 " style="margin-top:5%" >
                    <a href="{{route('tareas_estudiante',auth()->user()->id)}}"  class="col-xl-3 col-lg-3  btn btn-warning  py-4"><h5><b>Tareas</b></h5></a>
                </div>
            </div>
            <div style="margin-top:3%">
                <h4 style="color:black">Clases</h4>
            </div>

            @foreach($clases as $clase)
            <div class=" border-top">
                <?php $cont = 1; ?>
                @foreach($materias as $materia)
                @if($materia->id_materia == $clase->id_materia)
                <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}} {{$cont}}</h5>
                <?php $cont = 1; ?>
                @endif
                @endforeach
            </div>
            <div class="form-group row">



                <label class="col-xl-3 col-lg-1 col-form-label">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                <label class="col-xl-3 col-lg-1 col-form-label">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                <label class="col-xl-3 col-lg-1 col-form-label">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>

                <a href="{{$clase->link}}" target="_Blank" class="col-xl-3 col-lg-1  btn btn-success">Unirse a la clase</a>

            </div>
            <?php $cont++; ?>
            @endforeach
        </div>



    </div>
</div>
@endsection

@section('js')

<script>
    
    $('#inicio').addClass('kt-menu__item--active');
    /*  */
    $('#atras').hide()
</script>


@endsection