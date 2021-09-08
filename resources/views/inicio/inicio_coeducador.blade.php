@extends('layout.layout')
@section('titulo')
Inicio | Escuela Chile España
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
            Inicio
        </h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>

        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">
                Co-Educador
            </span>

        </div>
    </div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


    <div class="kt-portlet kt-portlet--tabs">

        @if($aux != 1)
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Inicio
                </h3>
            </div>
        </div>
        @if($flag == 1)
        <div class="kt-portlet__body">
            No tiene cursos
        </div>
        @endif
        @elseif($aux == 1 && auth()->user()->id_tipo_usuario == 3)
        @if($flag == 0)
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                    <?php $i = 1; ?>
                    @foreach($cursos as $curso)
                    <?php $item = '#kt_user_edit_tab_' . $i ?>
                    @if($i == 1)
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="{{$item}}" role="tab" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg> {{$curso->curso}}
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="{{$item}}" role="tab" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg> {{$curso->curso}}
                        </a>
                    </li>
                    @endif
                    <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('flash::message')




            <div class="tab-content">
                <?php $i = 1;
                $j = 0;
                ?>
                @foreach($cursos as $curso)

                <?php $item = 'kt_user_edit_tab_' . $i ?>

                @if($i == 1)

                <div class="tab-pane active" id="{{$item}}" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="mr-2"></div>
                            <div>
                                <a href="{{route('tareas_curso',$curso->id_curso)}}" type="submit" class="btn btn-dark font-weight-bolder" style="margin-bottom: 20px">Tareas del curso</a>
                            </div>
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    @foreach($clases[$j] as $clase)
                                    <div class=" border-top">

                                        @foreach($materias as $materia)
                                        @if($materia->id_materia == $clase->id_materia)
                                        <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}}: {{$clase->detalle}}</h5>

                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Profesor: {{$clase->nombre}} {{$clase->apellido_p}} {{$clase->apellido_m}} </label>
                                        <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                                        <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>

                                        <a href="{{$clase->link}}" target="_Blank" class="col-xl-3 col-lg-12  btn btn-warning">Unirse a la clase</a>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="tab-pane" id="{{$item}}" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="mr-2"></div>
                            <div>
                                <a href="{{route('tareas_curso',$curso->id_curso)}}" type="submit" class="btn btn-dark font-weight-bolder" style="margin-bottom: 20px">Tareas del curso</a>
                            </div>
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    @foreach($clases[$j] as $clase)
                                    <div class=" border-top">

                                        @foreach($materias as $materia)
                                        @if($materia->id_materia == $clase->id_materia)
                                        <h5 class="kt-section__title kt-section__title-sm" style="margin-top:10px; color: black;">{{$materia->materia}}</h5>

                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Profesor: {{$clase->nombre}} {{$clase->apellido_p}} {{$clase->apellido_m}} </label>
                                        <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Fecha: {{\Carbon\Carbon::parse($clase->fecha_clase)->format('d/m')}}</label>
                                        <label class="col-xl-3 col-lg-1 col-form-label" style="text-align: left;">Horario: {{\Carbon\Carbon::parse($clase->hora_inicio)->format('H:i')}}-{{\Carbon\Carbon::parse($clase->hora_fin)->format('H:i')}}</label>

                                        <a href="{{$clase->link}}" target="_Blank" class="col-xl-3 col-lg-12  btn btn-success">Unirse a la clase</a>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <?php $i++;
                $j++; ?>
                @endforeach
            </div>

            </form>
        </div>
        @else
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    No tine curso
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

        </div>
        @endif
        @endif

        @if(isset($cursos_jefe))
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Inicio
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            Inicio del profesor
        </div>
        @endif

    </div>

</div>
@endsection

@section('js')

<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>


<script>
    $('#inicio').addClass('kt-menu__item--active');
    $('#atras').hide()
</script>
@endsection