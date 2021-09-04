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
                    Perfil Administrador
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


                                    <div class="col-lg-1 col-xl-1">
                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                            {!!$errors->first('foto', '<small style="color:red">:message</small>')!!}
                                            <div class="kt-avatar__holder" style="background-image: url(&quot;{{$usuario->foto}}&quot;);"></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-11 col-xl-11">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="text-align: left;"> <b>Nombre: </b>{{$usuario->nombre}} {{$usuario->apellido_p}} {{$usuario->apellido_m}}</label>
                                        <label class="col-xl-9 col-lg-9 col-form-label" style="text-align: left;"> <b>Rut: </b>{{$usuario->rut}}</label>

                                        <label class="col-xl-3 col-lg-3 col-form-label" style="text-align: left;"> <b>Correo: </b> {{$usuario->email}}</label>
                                        <label class="col-xl-9 col-lg-9 col-form-label" style="text-align: left;"> <b>Telefono: </b> {{$usuario->telefono}}</label>
                                    </div>


                                </div>
                                <div class="form-group ">
                                    <a id="cambio_datos" href="{{route('cambio_datos',$usuario->id)}}" data-toggle="modal" data-target="#datos" class="btn btn-warning">Cambiar datos</a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal" id="datos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambio de datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="seed-csp4-description">
                    <p style="text-align: center;">Se envio un correo para confirmar el cambio de datos<br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/demo1/pages/custom/user/edit-user.js')}}" type="text/javascript"></script>
<script>
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/demo1/pages/custom/user/profile.js')}}" type="text/javascript"></script>
<script>
    $('#perfil').addClass('kt-menu__item--active');
    $("#cambio_datos").click(function() {

        var x = <?php echo $usuario->id ?>;
        console.log(x);
        $.ajax({
            data: {
               
                _token: $('input[name="_token"]').val()
            },
            url: "{{route('cambio_datos',$usuario->id)}}",
            type: "GET",
            beforeSend: function() {},
            success: function(response) {
                $("#provincia").html(response);
            },
            error: function() {
                alert("error")
            }
        });

    });
</script>
@endsection