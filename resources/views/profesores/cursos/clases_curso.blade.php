@extends('layout.layout')

@section('titulo')
Clases | Escuela Chile España
@endsection
@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Clases
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
                            Clases Pendientes
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    @include('flash::message')
                    <?php $cont = 1; ?>
                    @foreach($clases as $clase)
                    <div class="">

                        @foreach($materias as $materia)
                        @if($materia->id_materia == $clase->id_materia)
                        @if($clase->detalle != null)
                        <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}} {{$cont}}: "{{$clase->detalle}}"</h5>
                        @else
                        <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}} {{$cont}}: "Sin detalle"</h5>
                        @endif
                        

                        @endif
                        @endforeach
                    </div>
                    <div class="form-group row">



                        <label class="col-xl-4 col-lg-4 col-form-label">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                        <label class="col-xl-4 col-lg-4 col-form-label">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>

                        <a href="{{$clase->link}}" target="_Blank" class="col-xl-4 col-lg-4  btn btn-warning">Unirse a la clase</a>

                    </div>
                    <?php $cont++; ?>
                    <div class="border-bottom" style="margin-bottom:10px"></div>

                    @endforeach
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Agendar Clase
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <table id="materias" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th style="width:10%">Agendar</th>
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
            "ajax": "{{route('tabla.materias.curso.clases',$curso->id_curso)}}",
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
   
    $('#profesores_nav').addClass('kt-menu__item--open');
    $('#clases_nav').addClass('kt-menu__item--active');
    $('#curso_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--open');
    $('#clases_nav2_<?php echo $curso->id_curso ?>').addClass('kt-menu__item--active');
    
</script>

@endsection