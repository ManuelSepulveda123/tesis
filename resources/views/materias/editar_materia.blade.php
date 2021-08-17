@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
	.xd {
		background-color: pink;
	}
</style>
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">
			Editar Materia
		</h3>
		<span class="kt-subheader__separator kt-subheader__separator--v"></span>

		<div class="kt-subheader__group" id="kt_subheader_search">
			<span class="kt-subheader__desc" id="kt_subheader_total">
				{{$materia->materia}}
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
			<form action="{{route('materias_update',$materia->id_materia)}}" method="post" enctype="multipart/form-data">
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
												<h3 class="kt-section__title kt-section__title-sm">Materia {{$materia->materia}}:</h3>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Nombre materia</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('name_materia', '<small>:message</small>')!!}
												<input class="form-control" type="text" value="{{$materia->materia}}" name="name_materia">
											</div>
										</div>

										<div class="form-group row ">
											@if($materia->especifica == 1)
											<label class="col-xl-3 col-lg-3 col-form-label">Profesor especifico</label>
											@endif
											@if($materia->laboral == 1)
											<label class="col-xl-1 col-lg-1 col-form-label">Laboral</label>
											@endif
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Cursos</label>
											<div class="col-lg-9 col-xl-6">
												<select class="form-control js-example-basic-multiple"  name="cursos[]" multiple="multiple">
													<option value="0"  disabled>Seleccione profesor</option>
													@foreach($cursos as $curso)
													<option value="{{$curso->id_curso}}">{{$curso->curso}}</option>
													@endforeach
													@foreach($cursos_materia as $curso)
													<option value="{{$curso->id_curso}}" selected>{{$curso->curso}}</option>
													@endforeach
												</select>
											</div>
										</div>


										<div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
											<div class="mr-2"></div>
											<div>
												<button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Guardar Curso</button>
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
		$('.js-example-basic-multiple').select2();
	});
</script>

@endsection