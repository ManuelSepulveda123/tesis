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
            Lista de estudiantes
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                @if($curso != null)
                {{$curso->curso}}
                @endif
            </span>

        </div>
    </div>
</div>

@endsection


@section('content')
<div class="kt-portlet kt-portlet--mobile">
    @if($curso == null)
    <div class="d-flex justify-content-between  pt-10 mt-15">
        <div class="mr-2"></div>
        <div>
            <a href="{{route('profesores_crear')}}" type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" style="margin:20px">Agregar Profesor</a>
        </div>
    </div>
    @endif
    <div class="kt-portlet__body">
        @include('flash::message')
        <table id="profesores" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    @if($curso != null)
                    <th>Datos</th>
                    <th>Planificación</th>
                    @endif
                    @if($curso == null)
                    <th>Editar</th>
                    <th>Eliminar</th>
                    @endif
                </tr>
            </thead>

        </table>
    </div>
</div>
{{auth()->user()->id_tipo_usuario}}
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#profesores').DataTable({
            "ajax": "{{route('tabla.estudiantes',$curso->id_curso)}}",
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



    $('#profesores_nav').addClass('kt-menu__item--open');
</script>

@if(auth()->user()->id_tipo_usuario == 3)
<script>
    console.log('<?php echo $curso->id_curso ?>')
    $('#curso_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--open');
    $('#estudiantes_nav2_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--active');
</script>
@elseif(auth()->user()->id_tipo_usuario == 2 || auth()->user()->id_tipo_usuario == 1)
<script>
    if (<?php echo $curso->id_curso ?> == <?php echo $cursos->id_curso ?>) {
        $('#estudiantes_nav').addClass('kt-menu__item--active');
    } else {
        $('#curso_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--open');
        $('#estudiantes_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--active');

    }
</script>
@endif
@endsection