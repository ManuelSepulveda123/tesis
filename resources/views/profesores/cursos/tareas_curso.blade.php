@extends('layout.layout')

@section('titulo')
Tareas | Escuela Chile España
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" >
@endsection
@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Tareas
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$curso->curso}}
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">

        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Todas las tareas
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table id="tareas" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Materia</th>
                                <th>Fecha Subida</th>
                                <th>Fecha Fin</th>
                                <th style="width:10%">Ver</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Agregar Tarea
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    @include('flash::message')
                    <table id="materias" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th style="width:10%">Agregar</th>
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
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>



<script>
    $(document).ready(function() {
        $('#materias').DataTable({
            "ajax": "{{route('tabla.materias.tareas',$curso->id_curso)}}",
            "columns": [{
                    data: 'materia'
                },
                {
                    data: 'action'
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

    $(document).ready(function() {
        $('#tareas').DataTable({
            "ajax": "{{route('tabla.tareas.curso',$curso->id_curso)}}",
            "columns": [{
                    data: 'titulo'
                },
                {
                    data: 'materia'
                },
                {
                    data: 'fecha_subida'
                },
                {
                    data: 'fecha_plazo'
                },
                {
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
    });
    $('#profesores_nav').addClass('kt-menu__item--open');
    $('#tareas_nav').addClass('kt-menu__item--active');
    $('#curso_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--open');
    $('#tareas_nav2_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--active');
</script>

@endsection