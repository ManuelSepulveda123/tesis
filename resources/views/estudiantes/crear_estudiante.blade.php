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
            Nuevo usuario
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

        <div class="kt-portlet__body">
        @include('flash::message')
            <form action="{{route('estudiantes_store')}}" method="post" enctype="multipart/form-data">
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
                                                <h3 class="kt-section__title kt-section__title-sm">Detalles del estudiante:</h3>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-xl-3 col-lg-3 col-form-label">Nombres del estudiante</label>

                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('nombre')}}" name="nombre">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido paterno</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_p', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('apellido_p')}}" name="apellido_p">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido materno</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_m', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('apellido_m')}}" name="apellido_m">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Rut del estudiante</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('rut', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('rut')}}" placeholder="Rut sin . -" name="rut" id="rut" oninput="isValidRUT(value)" maxlength="12">
                                            </div>
                                        </div>

                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Fecha de nacimiento</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('fecha_nacimiento', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <input type="date" class="form-control" placeholder="Username" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Numero de telefono</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('telefono', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="number" class="form-control" value="{{old('telefono')}}" placeholder="Telefono" aria-describedby="basic-addon1" name="telefono">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Correo electronico</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('email', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                    <input type="email" class="form-control" value="{{old('email')}}" placeholder="exampled@gmail.com" aria-describedby="basic-addon1" name="email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Direccion del estudiante:</h3>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Region</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('region_provincia_comuna', '<small style="color:red">:message</small>')!!}
                                                <select class="form-control" name="region" id="region">
                                                    <option value="0" selected disabled>Seleccione región</option>
                                                    @foreach($regiones as $region)
                                                    <option value="{{$region->id}}">{{$region->region}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Provincia</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control" name="provincia" id="provincia">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Comuna</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control" name="comuna" id="comuna">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Direccion</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('direccion', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{old('direccion')}}" placeholder="" aria-describedby="basic-addon1" name="direccion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Curso del estudiante:</h3>

                                            </div>

                                        </div>

                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Curso</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('curso', '<small style="color:red">:message</small>')!!}
                                                <select class="form-control" name="curso">
                                                    <option value="0" selected>Seleccione un curso</option>
                                                    @foreach($cursos as $curso)
                                                    <option value="{{$curso->id_curso}}">{{$curso->curso}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Diagnostico del estudiante:</h3>

                                            </div>

                                        </div>

                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Diagnostico</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('diagnostico', '<small style="color:red">:message</small>')!!}
                                                <select class="form-control" name="diagnostico">
                                                    <option value="0" selected>Seleccione un diagnostico</option>
                                                    @foreach($diagnosticos as $diagnostico)
                                                    <option value="{{$diagnostico->id}}">{{$diagnostico->diagnostico}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Otro</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_m', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('otro')}}" name="otro">
                                            </div>
                                        </div>

                                        <div class="row border-top ">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6 ">
                                                <h3 class="kt-section__title kt-section__title-sm" style="margin-top:5%">Detalles del apoderado:</h3>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-xl-3 col-lg-3 col-form-label">Nombres del apoderado</label>

                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('nombre_apoderado', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('nombre_apoderado')}}" name="nombre_apoderado">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido paterno</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_p_apoderado', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('apellido_p_apoderado')}}" name="apellido_p_apoderado">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido materno</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_m_apoderado', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('apellido_m_apoderado')}}" name="apellido_m_apoderado">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Rut del apoderado</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('rut_apoderado', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{old('rut_apoderado')}}" placeholder="Rut sin . -" name="rut_apoderado" id="rut_apoderado" oninput="isValidRUT(value)" maxlength="12">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Numero de telefono</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('telefono_apoderado', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="number" class="form-control" value="{{old('telefono_apoderado')}}" placeholder="Telefono" aria-describedby="basic-addon1" name="telefono_apoderado">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Correo electronico</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('email_apoderado', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                    <input type="email" class="form-control" value="{{old('email_apoderado')}}" placeholder="exampled@gmail.com" aria-describedby="basic-addon1" name="email_apoderado">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
                                            <div class="mr-2"></div>
                                            <div>
                                                <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Registrar</button>
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

<script src="./assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>

<script src="./assets/js/demo1/pages/custom/user/edit-user.js" type="text/javascript"></script>
<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script>
    $(document).ready(function() {

        document.getElementById("rut").oninput = function isValidRUT(rut) {
            var rut = document.getElementById("rut");
            console.log(rut.value);

            rut.value = rut.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
        }

        document.getElementById("rut_apoderado").oninput = function isValidRUT(rut) {
            var rut = document.getElementById("rut_apoderado");
            console.log(rut.value);

            rut.value = rut.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
        }

        $('.select2').select2();

        $('#region').change(function() {

            var id_region = $("#region").val();
            $.ajax({
                data: {
                    id_region,
                    _token: $('input[name="_token"]').val()
                },
                url: "{{route('region.provincia')}}",
                type: "POST",
                beforeSend: function() {},
                success: function(response) {
                    $("#provincia").html(response);
                },
                error: function() {
                    alert("error")
                }
            });
            $('#comuna').empty();
        });

        $('#provincia').change(function() {
            var id_provincia = $("#provincia").val();
            $.ajax({
                data: {
                    id_provincia,
                    _token: $('input[name="_token"]').val()
                },
                url: "{{route('provincia.comuna')}}",
                type: "POST",
                beforeSend: function() {},
                success: function(response) {
                    $("#comuna").html(response);
                },
                error: function() {
                    alert("error")
                }
            });
        });
    });
</script>

<script>
    $('#tipo_user').change(function() {
        var id_tipo = $("#tipo_user").val();
        $.ajax({
            data: {
                id_tipo,
                _token: $('input[name="_token"]').val()
            },
            url: "{{route('tipo_usuario')}}",
            type: "POST",
            beforeSend: function() {},
            success: function(response) {
                $("#div-detalle").html(response);
            },
            error: function() {
                alert("error")
            }
        });
    });
</script>
@endsection