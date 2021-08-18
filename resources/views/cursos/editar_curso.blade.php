@extends('layout.layout')

@section('titulo')
Editar Curso | Escuela Chile España
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Editar Curso
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
    <div class="kt-portlet kt-portlet--tabs">

        <div class="kt-portlet__body">
            @include('flash::message')
            <form action="{{route('cursos_update',$curso->id_curso)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Detalles del Curso:</h3>
                                            </div>
                                        </div>


                                        <div class="form-group form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Año del Curso</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('ano_curso', '<small style="color:red">:message</small>')!!}
                                                <div class="input-group" id='datetimepicker1'>
                                                    <?php
                                                    $ano = \Carbon\Carbon::parse($curso->ano_curso)->format('Y');
                                                    ?>

                                                    <select class="form-control" name="ano_curso">
                                                        <option value="0" selected disabled>Seleccione el año</option>
                                                        @for ($cont = 0; $cont < 5; $cont++) @if($ano==\Carbon\Carbon::parse($curso->ano_curso)->format('Y'))
                                                            <option value="{{$ano}}-01-01" selected>{{$ano}}</option>
                                                            @else
                                                            <option value="{{$ano}}-01-01">{{$ano}}</option>
                                                            @endif
                                                            <?php $ano = $ano + 1 ?>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Nombre curso</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('curso', '<small style="color:red">:message</small>')!!}
                                                <input class="form-control" type="text" value="{{$curso->curso}}" name="curso">
                                            </div>
                                        </div>




                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Profesores:</h3>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Profesor jefe</label>
                                            <div class="col-lg-9 col-xl-6">
                                                {!!$errors->first('profesor', '<small style="color:red">:message</small>')!!}
                                                <select class="form-control" name="jefe">
                                                    <option value="0" selected disabled>Seleccione profesor</option>
                                                    @foreach($profesores as $profesor)
                                                    @if($jefe->id == $profesor->id)
                                                    <option value="{{$profesor->id}}" selected>{{$profesor->nombre}} {{$profesor->apellido_p}} {{$profesor->apellido_m}}</option>
                                                    @elseif(1==1)
                                                    <option value="{{$profesor->id}}">{{$profesor->nombre}} {{$profesor->apellido_p}} {{$profesor->apellido_m}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Profesor Ayudante</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control" name="ayudante">
                                                    <option value="0" selected disabled>Seleccione profesor</option>
                                                    @foreach($ayudantes as $profesor)
                                                    @if($ayudante->id == $profesor->id )
                                                    <option value="{{$profesor->id}}" selected>{{$profesor->nombre}} {{$profesor->apellido_p}} {{$profesor->apellido_m}}</option>
                                                    @elseif(1==1)
                                                    <option value="{{$profesor->id}}">{{$profesor->nombre}} {{$profesor->apellido_p}} {{$profesor->apellido_m}} </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between pt-10 mt-15" style="margin:20px">
                                            <div class="mr-2"></div>
                                            <div>
                                                <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Guardar Curso</button>
                                            </div>
                                        </div>

                                        <div class="border-top " data-wizard-type="">
                                            <div class="mr-2" style="margin-top:50px"></div>


                                            <div class="row">
                                                
                                                <div class="col-lg-9 col-xl-6">
                                                    <h3 class="kt-section__title kt-section__title-sm">Materias:</h3>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                
                                                    <table id="materias" class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre materia</th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                             
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
    </div>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#profesor_jefe').change(function() {
            var id_profesor = $("#profesor_jefe").val();
            $.ajax({
                data: {
                    id_profesor,
                    _token: $('input[name="_token"]').val()
                },
                url: "{{route('profesor.ayudante')}}",
                type: "POST",
                beforeSend: function() {},
                success: function(response) {
                    $("#profesor_ayudante").html(response);
                },
                error: function() {
                    alert("error")
                }
            });
            $('#comuna').empty();

        });
        $('#materias').DataTable({
            "ajax": "{{route('tabla.materias.curso',$curso->id_curso)}}",
            "columns": [{
                    data: 'materia'
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
    $('#administrador_nav').addClass('kt-menu__item--open');
    $('#tabla_cursos').addClass('kt-menu__item--active');
</script>

@endsection