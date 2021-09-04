@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">

        <h3 class="kt-subheader__title">
            Perfil
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
                    Perfil del usuario
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('flash::message')
            <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">

                                @if($usuario->foto != null)
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Foto</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                            {!!$errors->first('foto', '<small style="color:red">:message</small>')!!}
                                            <div class="kt-avatar__holder" style="background-image: url(&quot;{{$usuario->foto}}&quot;);"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row">

                                    <div class="col-lg-9 col-xl-6">
                                        <h3 class="kt-section__title kt-section__title-sm">Datos:</h3>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Nombre: </b>{{$usuario->nombre}} {{$usuario->apellido_p}} {{$usuario->apellido_m}}</label>


                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Rut:</b>{{$usuario->rut}}</label>

                                </div>

                                <div class="form-group" style="margin-bottom:10%">

                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Correo:</b> {{$usuario->email}}</label>
                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Telefono:</b> {{$usuario->telefono}}</label>

                                </div>


                                <div class="row border-top">

                                    <div class="col-lg-9 col-xl-6" style="margin-top:5%">
                                        <h3 class="kt-section__title kt-section__title-sm">Dirección:</h3>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Dirección:</b> {{$usuario->direccion}}</label>
                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Comuna:</b> {{$comuna->comuna}}</label>



                                </div>

                                <div class="form-group">
                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Region:</b> {{$region->region}}</label>
                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Provincia:</b> {{$provincia->provincia}}</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($usuario->id_tipo_usuario == 4)
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Curso
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('flash::message')

            <div class="form-group row">

                <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>{{$curso->curso}}</b></label>
                <div class="col-lg-6 col-xl-6" style="text-align: center;">
                    <a href="{{route('planificacion_descargar',$usuario->id)}}" target="_blank" class="btn btn-warning">Planificación</a>
                </div>


            </div>

        </div>
    </div>

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Datos del Apoderado
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('flash::message')
            <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">

                                <div class="form-group row">

                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Nombre: </b>{{$apoderado->nombre}} {{$apoderado->apellido_p}} {{$apoderado->apellido_m}}</label>

                                </div>

                                <div class="form-group" style="margin-bottom:10%">

                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Correo:</b> {{$apoderado->email}}</label>
                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: center;"> <b>Telefono:</b> {{$apoderado->telefono}}</label>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script>
    $(document).ready(function() {

        document.getElementById("rut").oninput = function isValidRUT(rut) {
            var rut = document.getElementById("rut");
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
<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/demo1/pages/custom/user/edit-user.js')}}" type="text/javascript"></script>
<script>
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/demo1/pages/custom/user/profile.js')}}" type="text/javascript"></script>
<script>
    
    $('#perfil').addClass('kt-menu__item--active');
</script>
@endsection