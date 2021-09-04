@extends('layout.layout')

@section('titulo')
Clases | Escuela Chile España
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
            Clases
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Clases pendientes
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="estudiantes" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Profesor</th>
                        <th>Materia</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Unirse</th>
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
            "ajax": "{{route('tabla2.clases')}}",
            "columns": [{
                    data: 'action1'
                },
                {
                    data: 'action3'
                },
                {
                    data: 'materia'
                },
                {
                    data: 'fecha_clase'
                },
                {
                    data: 'action4'
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
    });

    $('#clases_escuela').addClass('kt-menu__item--open');
    $('#tareas_nav').addClass('kt-menu__item--active');
</script>

@endsection