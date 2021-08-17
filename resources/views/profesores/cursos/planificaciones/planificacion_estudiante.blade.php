@extends('layout.layout')

@section('css')
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            {{$user->nombre}} {{$user->apellido_p}} {{$user->apellido_m}}
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                planificacion
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Planificacion
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                @include('flash::message')
                <!-- SI EXISTE UNA PLANIFICACION PARA EL ESTUDIANTE -->
                @if(isset($planificacion))
                <div class="form-group ">
                    <a class="btn btn-brand px-9 py-4" href="{{route('planificacion_descargar',$planificacion->id_archivo)}}">Descargar Planificación</a>


                </div>


                <div class="form-group ">

                    <label class="">Nueva planificacion</label>


                    <form action="{{route('planificacion_up', $user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="planificacion" accept="application/pdf, .doc, .docx, .odf" />
                        <div class="d-flex pt-10 mt-15" style="margin:20px">
                            <div class="mr-2"></div>
                            <div>
                                <button type="submit" class="btn btn-success   " style="margin:20px">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>
                @else


                <div class="form-group ">

                    <label class="">Suba la planificacion para el estudiante</label>


                    <form action="{{route('planificacion_up', $user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="planificacion" accept="application/pdf, .doc, .docx, .odf" />
                        <div class="d-flex pt-10 mt-15" style="margin:20px">
                            <div class="mr-2"></div>
                            <div>
                                <button type="submit" class="btn btn-success   " style="margin:20px">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>
                @endif





            </div>

        </div>



    </div>
</div>
@endsection
@section('js')



@endsection