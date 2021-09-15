@extends('layout.layout')

@section('titulo')
Clases | Escuela Chile España
@endsection
@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            {{$curso_1->curso}} - {{\Carbon\Carbon::parse($curso_1->ano_curso)->format('Y')}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                Clases
            </span>

        </div>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$materia_1->materia}}
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Clases Pendientes
                </h3>
            </div>
        </div>



        <div class="kt-portlet__body">
            @include('flash::message')
            <div class="mr-2"></div>
            <div>
                <a href="" data-toggle="modal" data-target="#agregar_clase" type="submit" class="btn btn-dark font-weight-bolder" style="margin-bottom: 20px">Nueva Clase</a>
            </div>

            <?php $cont = 1; ?>
            @foreach($clases as $clase)
            <?php date_default_timezone_set('America/Santiago');
            $fecha = date_format(date_create(), 'Y-m-d'); ?>
            <div class="border-top">

                @if($clase->detalle != null)
                <b>
                    <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}}:
                </b> {{$clase->detalle}}</h5>
                @else
                <b>
                    <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}}:
                </b> Sin titulo</h5>
                @endif
            </div>
            <div class="form-group row">



                <label class="col-xl-3 col-lg-3 col-form-label">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                <label class="col-xl-3 col-lg-3 col-form-label">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>
                @if($fecha == $clase->fecha_clase)
                <div class="col-xl-3 col-lg-12" style="align-content: center;" width="100%">
                    <a href="{{$clase->link}}" target="_Blank" class="col-xl-12 col-lg-12  btn btn-warning">Unirse a la clase</a>
                </div>
                <div class="col-xl-2 col-lg-12" style="align-content: center;" width="100%">
                    <form action="{{route('clase_eliminar',$clase->id_clase)}}" method="post">
                        @csrf
                        <button class="col-xl-12 col-lg-12  btn btn-danger">Eliminar</button>

                    </form>
                </div>
                @else
                <div class="col-xl-2 col-lg-12" style="align-content: center;" width="100%">
                    <form action="{{route('clase_eliminar',$clase->id_clase)}}" method="post">
                        @csrf
                        <button class="col-xl-12 col-lg-12  btn btn-danger">Eliminar</button>
                    </form>
                </div>

                @endif


            </div>
            <?php $cont++; ?>


            @endforeach
        </div>

    </div>

</div>

<div class="modal " id="agregar_clase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Clase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('clase_store',['id_materia' => $materia_1->id_materia, 'id_curso' => $curso_1->id_curso])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h3 class="kt-section__title kt-section__title-sm">Agendar Clase:</h3>
                                                </div>
                                            </div>

                                            <input type="hidden" name="redirect" value="1">
                                            <div class="form-group form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">fecha</label>
                                                <div class="col-lg-9 col-xl-3">
                                                    {!!$errors->first('fecha', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="date" value="{{old('fecha')}}" name="fecha">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h3 class="kt-section__title kt-section__title-sm">Horario:</h3>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Inicio</label>
                                                <div class="col-lg-2 col-xl-2">
                                                    {!!$errors->first('hora_inicio', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="time" value="{{old('hora_inicio')}}" name="hora_inicio">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Fin</label>
                                                <div class="col-lg-2 col-xl-2">
                                                    {!!$errors->first('hora_fin', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="time" value="{{old('hora_fin')}}" name="hora_fin">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h3 class="kt-section__title kt-section__title-sm">Información:</h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Titulo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    {!!$errors->first('curso', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="text" value="{{old('detalle')}}" name="detalle">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Link</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    {!!$errors->first('link', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="text" value="{{old('link')}}" name="link">
                                                </div>
                                            </div>





                                            <div class="d-flex justify-content-between  pt-10 mt-15" style="margin:20px">
                                                <div class="mr-2"></div>
                                                <div>
                                                    <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Crear clase</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>



<script>
    $('#profesores_especifico_nav').addClass('kt-menu__item--open');
    $('#curso_{{$curso_1->id_curso}}').addClass('kt-menu__item--open');
    $('#clase_{{$curso_1->id_curso}}').addClass('kt-menu__item--active');
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>

@endsection