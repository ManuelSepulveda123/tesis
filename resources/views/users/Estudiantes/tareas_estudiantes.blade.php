@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    @include('flash::message')
    <div class="row">

        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tareas Pendientes
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table id="tareas_pendientes" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>Materia</th>
                                <th>Fecha Subida</th>
                                <th>Descargar</th>
                                <th>Entregar</th>
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
                            Tareas Entregadas
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table id="tareas_entregadas" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>Materia</th>
                                <th>Fecha Subida</th>
                                <th>Descargar</th>
                                <th>Modificar</th>
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
        $('#tareas_pendientes').DataTable({
            "ajax": "{{route('tabla.estudiantes_tareas_p')}}",
            "columns": [{
                data: 'materia'
            }, {
                data: 'fecha_archivo'
            }, {
                data: 'action'
            }, {
                data: 'action2'
            }],
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

        $('#tareas_entregadas').DataTable({
            "ajax": "{{route('tabla.estudiantes_tareas')}}",
            "columns": [{
                data: 'materia'
            },{
                data: 'fecha_archivo'
            }, {
                data: 'action'
            }, {
                data: 'action2'
            }],
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
    $('#tareas').addClass('kt-menu__item--open');
</script>
<script src="./assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>
@endsection