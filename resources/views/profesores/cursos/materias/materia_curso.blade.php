@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            {{$materia->materia}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$curso->curso}}
            </span>

        </div>
    </div>


</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
@include('flash::message')
    <div class="row">
   
        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Clases
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    
                    <div class="form-group ">
                        <a href="{{route('clase_crear',['id_materia' => $materia->id_materia, 'id_curso' => $curso->id_curso])}}" class="btn btn-brand px-9 py-4" href="#" style="float: right;">Agregar clase</a>

                    </div>

                    <?php $cont = 1; ?>
                    @foreach($clases as $clase)
                    <div class="row border-top">


                        <h4 class="kt-section__title kt-section__title-sm" style="margin-top:10px">Clase {{$cont}}</h4>

                    </div>
                    <div class="form-group row">



                        <label class="col-xl-3 col-lg-5 col-form-label">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                        <label class="col-xl-3 col-lg-5 col-form-label">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>
                      
                        <a href="{{$clase->link}}" target="_Blank" class="col-xl-3 col-lg-5  btn btn-success" >Unirse a la clase</a>
                       
                    </div>
                    <?php $cont++; ?>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tareas
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    @include('flash::message')
                    <div class="form-group ">
                        <a href="{{route('tarea_crear',['id_materia' => $materia->id_materia, 'id_curso' => $curso->id_curso])}}" class="btn btn-brand px-9 py-4" href="#" style="float: right;">Agregar clase</a>
                    </div>


                    <?php $cont = 1; ?>
                    @foreach($tareas as $tarea)
                    <div class="row border-top">
                        <h4 class="kt-section__title kt-section__title-sm" style="margin-top:10px">Tarea {{$cont}}</h4>
                    </div>
                    <div class="form-group row">

                        <label class="col-xl-3 col-lg-3 col-form-label">Fecha: {{\Carbon\Carbon::parse($tarea->fecha_archivo)->format('d/m')}}</label>
                        <a href="{{route('tarea_descargar',$tarea->id_archivo)}}"  class="col-xl-3 col-lg-4  btn btn-success">Descargar tarea</a>
                        <a href="{{route('tarea_eliminar',$tarea->id_archivo)}}"  class="col-xl-3 col-lg-4  btn btn-danger" style="margin-left:10%" onclick="return confirm(`¿Está seguro que desea eliminar esta tarea?`);">Eliminar</a>

                    </div>
                    <?php $cont++; ?>
                    @endforeach

                </div>

            </div>
        </div>



    </div>

</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection