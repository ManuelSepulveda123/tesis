@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('titulo')
Tarea | Escuela Chile España
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            {{$tarea->titulo}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$tarea->materia}}
            </span>


        </div>
    </div>


</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    @if(isset($archivo))
    <div class="row">

        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Detalle de la tarea
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group ">
                                        <h4 class="col-xl-4 col-lg-4"><b>Titulo: </b>{{$tarea->titulo}}</h4>
                                        <h4 class="col-xl-8 col-lg-8"><b>Fecha de entrega: </b>{{$tarea->fecha_plazo}}</h4>
                                        <br>
                                        <br>
                                        <br>
                                        @if($tarea->actividad != null)
                                        <h4 class="col-xl-12 col-lg-12"><b>Actividad</b></h4>
                                        <h4 class="col-xl-12 col-lg-12">{{$tarea->actividad}}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <div class="kt-portlet kt-portlet--mobile" style="height: responsive;">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Archivo adjunto
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <a href="{{route('tarea_descargar',$archivo->id_archivo)}}" class="btn btn-warning">Descargar</a>

                </div>
            </div>
        </div>
    </div>
    @else
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Detalle de la tarea
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">

            <div class="kt-form kt-form--label-right">
                <div class="kt-form__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="form-group ">
                                <h4 class="col-xl-4 col-lg-4"><b>Titulo: </b>{{$tarea->titulo}}</h4>
                                <h4 class="col-xl-8 col-lg-8"><b>Fecha de entrega: </b>{{$tarea->fecha_plazo}}</h4>
                                <br>
                                <br>
                                <br>
                                @if($tarea->actividad != null)
                                <h4 class="col-xl-12 col-lg-12"><b>Actividad</b></h4>
                                <h4 class="col-xl-12 col-lg-12">{{$tarea->actividad}}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Tarea
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            @include('flash::message')
            <div class="kt-form kt-form--label-right">
                <div class="kt-form__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="form-group ">
                                <h4 class="col-xl-12 col-lg-12"><b>Fecha de entrega: </b>{{$tarea_estudiante->fecha_subida}}</h4>
                                <br>
                                <br>
                                <br>
                                <div class="container">
                                <a href="{{route('tarea_descargar',$tarea_estudiante->id_archivo)}}"class="col-xl-12 col-lg-12 btn btn-warning">Mi tarea</a>
                                </div>
                                
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#materias_estudiante').addClass('kt-menu__item--open');
    $('#<?php echo $tarea->id_materia; ?>').addClass('kt-menu__item--active');
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection