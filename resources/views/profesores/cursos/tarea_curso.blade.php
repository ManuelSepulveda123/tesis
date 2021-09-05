@extends('layout.layout')

@section('titulo')
Tarea | Escuela Chile España
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
            {{$tarea->titulo}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                Tarea
            </span>

        </div>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$tarea->curso}}
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">

        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Detalles de la tarea
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    @if(Auth::user()->id_tipo_usuario != 1 )
                    @include('flash::message')
                    <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <form action="{{route('tarea_update',$tarea->id_tarea)}}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Titulo</label>

                                                <div class="col-lg-9 col-xl-6">
                                                    {!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="text" value="{{$tarea->titulo}}" name="nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Actividad</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    {!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
                                                    <textarea class="form-control" name="actividad" id="" cols="30" rows="10" style="resize: none;">{{$tarea->actividad}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Fecha plazo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    {!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
                                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::parse($tarea->fecha_plazo)->format('Y-m-d')}}" name="fecha_plazo">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
                                                <div class="mr-2"></div>
                                                <div>
                                                    <button type="submit" class="btn btn-success font-weight-bolder" style="margin:20px">Guardar</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else

                    <div class="kt-section__body">
                        <div class="form-group ">
                            <label class="col-xl-12 col-lg-12 col-form-label" style="text-align: left;"><b>Titulo: </b>{{$tarea->titulo}}</label>
                            <label class="col-xl-12 col-lg-12 col-form-label" style="text-align: left;"><b>Actividad: </b>{{$tarea->actividad}}</label>
                            <label class="col-xl-12 col-lg-12 col-form-label" style="text-align: left;"><b>Fecha plazo: </b> {{$tarea->fecha_plazo}}</label>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Archivo adjunto
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    @if($tarea->id_archivo != null)
                    <a href="{{route('tarea_descargar',$tarea->id_archivo)}}" class="btn btn-warning">Descargar</a>
                    @else
                    <label class="">No hay archivo adjunto</label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Tareas Estudiantes
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="estudiantes" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha</th>
                        <th>Comentario</th>
                        <th>Descargar</th>
                    </tr>
                </thead>

            </table>
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
    $(document).ready(function() {
        $('#estudiantes').DataTable({
            "ajax": "{{route('tabla.tareas.estudiantes',$tarea->id_tarea)}}",
            "columns": [{
                    data: 'rut'
                },
                {
                    data: 'action'
                },
                {
                    data: 'email'
                },
                {
                    data: 'fecha_subida'
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
    });

    $('#profesores_nav').addClass('kt-menu__item--open');
    $('#tareas_nav').addClass('kt-menu__item--active');
</script>

@endsection