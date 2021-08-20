@extends('layout.layout')
@section('titulo')
Lista Estudiantes | Escuela Chile España
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
            Estudiantes
        </h3>
    </div>
</div>

@endsection


@section('content')
<div class="kt-portlet kt-portlet--mobile">

    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Lista de Estudiantes
            </h3>
        </div>
    </div>



    <div class="kt-portlet__body">

        @include('flash::message')
        <div class="d-flex justify-content-between  pt-10 mt-15">
            <div class="mr-2"></div>
            <div>
                <a href="{{route('estudiantes_crear')}}" type="submit" class="btn btn-warning font-weight-bolder px-9 py-4" style="margin:20px">Agregar Estudiante</a>
            </div>
        </div>
        <table id="profesores" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Curso</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

        </table>
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
        $('#profesores').DataTable({
            "ajax": "{{route('tabla.estudiantes')}}",
            "columns": [{
                    data: 'rut'
                },
                {
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
                },{
                    data:'curso'
                },
                {
                    data: 'action'
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

    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
    $('#administrador_nav').addClass('kt-menu__item--open');
    $('#tabla_estudiantes').addClass('kt-menu__item--active');
</script>

@endsection