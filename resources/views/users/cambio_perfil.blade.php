@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">

        <h3 class="kt-subheader__title">
            Datos
        </h3>

        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$usuario->nombre}} {{$usuario->apellido_p}} {{$usuario->apellido_m}}
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
                    Actualizar datos
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('flash::message')
            <form action="{{route('admin_update',$usuario->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                                    {!!$errors->first('foto', '<small style="color:red">:message</small>')!!}
                                                    <div class="kt-avatar__holder" style="background-image: url(&quot;{{asset($usuario->foto)}}&quot;);"></div>
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen"></i>
                                                        <input type="file" name="foto" accept=".png, .jpg, .jpeg">
                                                    </label>
                                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-xl-3 col-lg-3 col-form-label">Nombres </label>

                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{$usuario->nombre}}" name="nombre">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido paterno</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_p', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{$usuario->apellido_p}}" name="apellido_p">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido materno</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('apellido_m', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{$usuario->apellido_m}}" name="apellido_m">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Rut</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('rut', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{$usuario->rut}}" placeholder="Rut sin . -" name="rut" id="rut" oninput="isValidRUT(value)" maxlength="12">
                                            </div>
                                        </div>

                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Fecha de nacimiento</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('fecha_nacimiento', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <input type="date" class="form-control" placeholder="Username" value="{{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('Y-m-d')}}" name="fecha_nacimiento">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Numero de telefono</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('telefono', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="number" class="form-control" value="{{$usuario->telefono}}" placeholder="Telefono" aria-describedby="basic-addon1" name="telefono">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Correo electronico</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('email', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                    <input type="email" class="form-control" value="{{$usuario->email}}" placeholder="exampled@gmail.com" aria-describedby="basic-addon1" name="email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Nueva Contraseña</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('email', '<small style="color:red">:message</small>')!!}

                                                <input type="text" class="form-control" value="" placeholder="****" aria-describedby="basic-addon1" name="contra" autocomplete="off">

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Confirmar contraseña</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('email', '<small style="color:red">:message</small>')!!}

                                                <input type="text" class="form-control" value="" placeholder="****" aria-describedby="basic-addon1" name="contra2" autocomplete="off">

                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
                                            <div class="mr-2"></div>
                                            <div>
                                                <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Guardar1</button>
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

<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/demo1/pages/custom/user/edit-user.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/demo1/pages/custom/user/profile.js')}}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        document.getElementById("rut").oninput = function isValidRUT(rut) {
            var rut = document.getElementById("rut");
            console.log(rut.value);

            rut.value = rut.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
        }
    });
</script>
<script>
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
@endsection