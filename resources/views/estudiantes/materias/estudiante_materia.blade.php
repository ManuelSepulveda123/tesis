@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .xd {
        background-color: pink;
    }
</style>
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
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Tareas Pendientes
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('flash::message')
            <?php $cont = 1; ?>
            @foreach($tareas_pendientes as $tarea)

            <h4 class="kt-section__title kt-section__title-sm">Tarea {{$cont}}</h4>

            <div class="form-group row ">

                <label class="col-xl-3 col-lg-3 col-form-label">Fecha: {{\Carbon\Carbon::parse($tarea->fecha_archivo)->format('d/m')}}</label>
                <a href="{{route('tarea_descargar',$tarea->id_archivo)}}" class="col-xl-3 col-lg-4  btn btn-warning">Descargar tarea</a>
                <a href="{{route('tarea_estudiante_up',['id' => $id, 'id_tarea' => $tarea->id_archivo])}}" class="col-xl-3 col-lg-4  btn btn-dark" style="margin-left:10%">Subir</a>

            </div>
            <div class="border-bottom"></div>
            <?php $cont++; ?>
            @endforeach
            @if($cont == 1)
            <h4 class="kt-section__title kt-section__title-sm">No hay tareas pendientes</h4>
            @endif
         
            
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#materias_estudiante').addClass('kt-menu__item--open');
    $('#<?php echo $id_materia; ?>').addClass('kt-menu__item--active');
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection