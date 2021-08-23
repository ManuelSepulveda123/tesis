@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">

        <h3 class="kt-subheader__title">
            {{$curso->curso}} - {{$curso->ano_curso}}
        </h3>

        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                Perfil
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">

        <div class="col-md-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Lista de estudiantes
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apelldio paterno</th>
                                <th>Apellido materno</th>
                                <th>Correo</th>
                                <th>planificacion</th>

                            </tr>
                        </thead>

                    </table>


                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Profesores
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <h5><b>Profesor Jefe</b></h5>
                    <div class="form-group row">


                        <div class="col-lg-4 col-xl-4">
                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                {!!$errors->first('foto', '<small style="color:red">:message</small>')!!}
                                <div class="kt-avatar__holder" style="background-image: url(&quot;{{$curso->foto}}&quot;);"></div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-8">
                            <label class="col-lg-8 col-xl-8"><b>Nombre: </b>{{$curso->nombre}} {{$curso->apellido_p}} {{$curso->apellido_m}}</label>
                            <label class="col-lg-8 col-xl-8"><b>Correo: </b>{{$curso->email}} </label>
                            <label class="col-lg-8 col-xl-8"><b>Telefono: </b>{{$curso->telefono}} </label>
                        </div>

                    </div>

                    @if(isset($ayudante))
                    <h5><b>Coeducador</b></h5>
                    <div class="form-group row">


                        <div class="col-lg-4 col-xl-4">
                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                {!!$errors->first('foto', '<small style="color:red">:message</small>')!!}
                                <div class="kt-avatar__holder" style="background-image: url(&quot;{{$ayudante->foto}}&quot;);"></div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-8">
                            <label class="col-lg-8 col-xl-8"><b>Nombre: </b>{{$ayudante->nombre}} {{$ayudante->apellido_p}} {{$ayudante->apellido_m}}</label>
                            <label class="col-lg-8 col-xl-8"><b>Correo: </b>{{$ayudante->email}} </label>
                            <label class="col-lg-8 col-xl-8"><b>Telefono: </b>{{$ayudante->telefono}} </label>
                        </div>

                    </div>
                    @else
                    <h5><b>Coeducador</b></h5>
                    Sin coeducador
                    @endif

                </div>
            </div>
        </div>





    </div>
    <div class="row">

        <div class="col-md-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tareas
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de subida</th>
                                <th>Fecha de fin</th>
                                <th>Descargar</th>

                            </tr>
                        </thead>

                    </table>


                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Clases
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                <table id="example3" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>detalle</th>
                                <th>Fecha clase</th>
                                <th>Horario</th>
                                <th>link</th>

                            </tr>
                        </thead>

                    </table>


                </div>
            </div>
        </div>





    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->

<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/demo1/pages/custom/user/edit-user.js')}}" type="text/javascript"></script>
<script>
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/demo1/pages/custom/user/profile.js')}}" type="text/javascript"></script>
<script>
    $('#administrador2_nav').addClass('kt-menu__item--open');
    $('#tabla_cursos2').addClass('kt-menu__item--active');
</script>
<script>
    $('#example').DataTable({
        "ajax": "{{route('tabla.estudiantes.curso',$curso->id_curso)}}",
        "columns": [{
                data: 'nombre'
            },
            {
                data: 'apellido_p'
            },
            {
                data: 'apellido_m'
            },
            {
                data: 'email'
            }, {
                data: 'action'
            }
        ],
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('#example2').DataTable({
        "ajax": "{{route('tabla.tareas.curso',$curso->id_curso)}}",
        "columns": [{
                data: 'action'
            },
            {
                data: 'fecha_archivo'
            },
            {
                data: 'action2'
            },
            {
                data: 'action3'
            },
        ],
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('#example3').DataTable({
        "ajax": "{{route('tabla.clases',$curso->id_curso)}}",
        "columns": [{
                data: 'detalle'
            },
            {
                data: 'fecha_clase'
            },
            {
                data: 'action1'
            },
            {
                data: 'action2'
            },
        ],
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
</script>
@endsection