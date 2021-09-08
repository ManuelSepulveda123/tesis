@extends('layout.layout')
@section('titulo')
Inicio | Escuela Chile España
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
                Profesor
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--tabs">

        @if($aux != 1)
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Inicio
                </h3>
            </div>
        </div>
        @if($flag == 1)
        <div class="kt-portlet__body">
            No tiene cursos
        </div>
        @endif
        @elseif($aux == 1 && auth()->user()->id_tipo_usuario == 2)
        @if($flag == 0)
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{$cursos->curso}} - {{\Carbon\Carbon::parse($cursos->ano_curso)->format('Y')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="mr-2"></div>
                        <div>
                            <a href="{{route('tareas_curso',auth()->user()->id)}}" type="submit" class="btn btn-dark font-weight-bolder" style="margin-bottom: 20px">Tareas del curso</a>
                        </div>
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                @foreach($clases as $clase)
                                <div class=" border-top">

                                    @foreach($materias as $materia)
                                    @if($materia->id_materia == $clase->id_materia)
                                    <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}}: {{$clase->detalle}}</h5>

                                    @endif
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Profesor: {{$clase->nombre}} {{$clase->apellido_p}} {{$clase->apellido_m}} </label>
                                    <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                                    <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>

                                    <a href="{{$clase->link}}" target="_Blank" class="col-xl-3 col-lg-12  btn btn-warning">Unirse a la clase</a>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    No tine curso
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

        </div>
        @endif
        @endif

        @if(isset($cursos_jefe))
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Inicio
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            Inicio del profesor
        </div>
        @endif

    </div>

</div>
@endsection

@section('js')

<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>


<script>
    $('#inicio').addClass('kt-menu__item--active');
    $('#atras').hide()
</script>
@endsection