@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Subir tarea
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                {{$materia->materia}}
            </span>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{$curso->curso}}
                </span>
            </div>
        </div>
    </div>


</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">

        <div class="kt-portlet__body">
            @include('flash::message')


            <div class="tab-content">
                <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">

                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Subir Tarea:</h3>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-lg-9 col-xl-6">

                                            <form action="{{route('subir_tarea_estudiante_up',['id' => $id, 'id_tarea' => $id_tarea])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="tarea" accept="application/pdf, .doc, .docx, .odf" />
                                                <div class="d-flex pt-10 mt-15" style="margin:20px">
                                                    <div class="mr-2"></div>
                                                    <div>
                                                        <button type="submit" class="btn btn-warning   " style="margin:20px">Guardar</button>
                                                      
                                                    </div>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#materias_estudiante').addClass('kt-menu__item--open');
    $('#<?php echo $materia->id_materia; ?>').addClass('kt-menu__item--active');
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection