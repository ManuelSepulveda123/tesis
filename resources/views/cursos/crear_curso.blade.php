@extends('layout.layout')

@section('titulo')
Crear Curso | Escuela Chile España
@endsection


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Nuevo curso
        </h3>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">

        <div class="kt-portlet__body">
            @include('flash::message')
            <form action="{{route('cursos_store')}}" method="post" enctype="multipart/form-data">
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
                                                <h3 class="kt-section__title kt-section__title-sm">Detalles del Curso:</h3>
                                            </div>
                                        </div>


                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Año del Curso</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('ano_curso', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group" id='datetimepicker1'>
                                                    <?php
                                                    $ano = date('Y');
                                                    ?>

                                                    <select class="form-control" name="ano_curso">
                                                        <option value="0" selected disabled>Seleccione el año</option>
                                                        @for ($cont = 0; $cont < 5; $cont++) <option value="{{$ano}}-01-01">{{$ano}}</option>
                                                            <?php $ano = $ano + 1 ?>
                                                            @endfor

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Nombre curso</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('curso', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('curso')}}" name="curso">
                                            </div>
                                        </div>




                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Profesores:</h3>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Profesor jefe</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('profesor', '<small style="color:red">:message</small>')!!}
                                                <select class="form-control" name="jefe">
                                                    <option value="0" selected disabled>Seleccione profesor</option>
                                                    @foreach($profes_sin_curso as $profesor)
                                                    <option value="{{$profesor->id}}">{{$profesor->nombre}} {{$profesor->apellido_p}} {{$profesor->apellido_m}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Profesor Ayudante</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control" name="ayudante">
                                                    <option value="0" selected disabled>Seleccione profesor</option>
                                                    @foreach($ayudantes_sin_curso as $ayudante)
                                                    <option value="{{$ayudante->id}}">{{$ayudante->nombre}} {{$ayudante->apellido_p}} {{$ayudante->apellido_m}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
                                            <div class="mr-2"></div>
                                            <div>
                                                <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Guardar Curso</button>
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
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#administrador_nav').addClass('kt-menu__item--open');
    $('#tabla_cursos').addClass('kt-menu__item--active');
</script>
@endsection