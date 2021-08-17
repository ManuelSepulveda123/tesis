@extends('layout.layout')

@section('titulo')
Lista Cursos | Escuela Chile España
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
            Lista de Cursos
        </h3>
    </div>
</div>

@endsection

@section('content')
<div class="kt-portlet kt-portlet--mobile">

    <div class="d-flex justify-content-between  pt-10 mt-15">
        <div class="mr-2"></div>
        <div>
            <a href="{{route('cursos_crear')}}" type="submit" class="btn btn-warning font-weight-bolder px-9 py-4" style="margin:20px">Agregar Curso</a>
        </div>
    </div>

    <div class="kt-portlet__body">
        @include('flash::message')
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Curso</th>
                    <th>Profesor</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Correo</th>
                    <th>editar</th>
                    <th>eliminar</th>
                </tr>
            </thead>

        </table>


    </div>




</div>


<div class="kt-portlet kt-portlet--mobile">


    <div class="kt-portlet__body">

        <label class="col-form-label">Atención: Al eliminar un curso vuelva a cargar la pagina.</label>



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
        $('#example').DataTable({
            "ajax": "{{route('tabla.cursos')}}",
            "columns": [{
                    data: 'ano_curso'
                },
                {
                    data: 'curso'
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
                },
                {
                    data: 'action'
                },
                {
                    data: 'action2'
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
    $('#administrador_nav').addClass('kt-menu__item--open');
    $('#tabla_cursos').addClass('kt-menu__item--active');
</script>

@endsection