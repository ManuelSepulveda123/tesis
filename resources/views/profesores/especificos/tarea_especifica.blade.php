@extends('layout.layout')

@section('titulo')
Tareas | Escuela Chile España
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
            {{$curso_1->curso}} - {{\Carbon\Carbon::parse($curso_1->ano_curso)->format('Y')}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                Tareas
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
                    Todas las tareas
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            @include('flash::message')
            <div class="d-flex justify-content-between  pt-10 mt-15">
                <div class="mr-2"></div>
                <div>
                    <a href="" data-toggle="modal" data-target="#agregar_clase" type="submit" class="btn btn-warning font-weight-bolder px-9 py-4" style="margin:20px">Nueva Tarea</a>
                </div>
            </div>
            <table id="tareas" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Tarea</th>
                        <th>Fecha Subida</th>
                        <th>Fecha Fin</th>
                        <th style="width:10%">Ver</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>

</div>

<div class="modal " id="agregar_clase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('tarea_up',['id_curso' => $curso_1->id_curso, 'id_materia' => $materia_1->id_materia])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Titulo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" name="nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Plazo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="date" name="fecha_fin">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Archivo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="file" name="tarea" accept="application/pdf, .doc, .docx, .odf" />
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between pt-10 mt-15" style="margin:20px">
                                                <div class="mr-2"></div>
                                                <div>
                                                    <button type="submit" class="btn btn-warning font-weight-bolder px-9 " style="margin:20px">Guardar</button>
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
    $(document).ready(function() {
        $('#tareas').DataTable({
            "ajax": "{{route('tabla.materia.tareas',['id_curso' => $curso_1->id_curso, 'id_materia' => $materia_1->id_materia])}}",
            "columns": [{
                data: 'action'
            }, {
                data: 'fecha_archivo'
            }, {
                data: 'action2'
            }, {
                data: 'action3'
            }, ],
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


    $('#profesores_especifico_nav').addClass('kt-menu__item--open');
    $('#curso_{{$curso_1->id_curso}}').addClass('kt-menu__item--open');
    $('#tarea_{{$curso_1->id_curso}}').addClass('kt-menu__item--active');
</script>

@endsection