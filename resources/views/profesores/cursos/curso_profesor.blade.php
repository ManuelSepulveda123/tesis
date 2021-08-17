@extends('layout.layout')

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            {{$curso->curso}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                curso
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
                            Materias
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <table id="materias" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Materia</th>
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
                            Estudiantes
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table id="estudiantes" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>rut</th>
                                <th>Nombres</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th style="width:10%">planificacion</th>
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
            "ajax": "{{route('tabla.materias.curso',$curso->id_curso)}}",
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
        $('#estudiantes').DataTable({
            "ajax": "{{route('tabla.estudiantes.curso',$curso->id_curso)}}",
            "columns": [
                {data: 'rut'},
                {data: 'nombre'},
                {data: 'apellido_p'},
                {data: 'apellido_m'},
                {data: 'action'},


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
</script>

@endsection