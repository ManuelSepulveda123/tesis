@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Nueva clase
        </h3>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">

        <div class="kt-portlet__body">
            @include('flash::message')
            <form action="{{route('clase_store',['id_materia' => $materia->id_materia, 'id_curso' => $curso->id_curso])}}" method="post" enctype="multipart/form-data">
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
                                            <label class="col-xl-3 col-lg-3 col-form-label">Link</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('link', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('link')}}" name="link">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">contraseña</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('password', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('password')}}" name="password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Detalle</label>
                                            <div class="col-lg-2 col-xl-4">
                                                {!!$errors->first('curso', '<small style="color:red">:message</small>')!!}
                                                <textarea  class="form-control" name="detalle" rows="4" cols="50" style="resize: none"></textarea>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
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
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection