@extends('layout.layout')

@section('titulo')
Crear Materia | Escuela Chile España
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">
			Nuevo materia
		</h3>
	</div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--tabs">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Dato Materia
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			@include('flash::message')
			<form action="{{route('materias_store')}}" method="post" enctype="multipart/form-data">
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
												<h3 class="kt-section__title kt-section__title-sm">Detalles de la Materia:</h3>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Nombre materia</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('name_materia', '<small>:message</small>')!!}
												<input class="form-control" type="text" value="{{old('name_materia')}}" name="name_materia">
											</div>
										</div>

										<div class="form-group row ">
											<label class="col-xl-3 col-lg-3 col-form-label">Profesor especifico</label>
											<div class="input-group-prepend">
												<span class="input-group-text">

													<input type="checkbox" value="1" name="especifico">
												</span>

											</div>

											<label class="col-xl-1 col-lg-1 col-form-label">Laboral</label>
											<div class="input-group-prepend">
												<span class="input-group-text">

													<input type="checkbox" value="1" name="laboral">

												</span>
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
@endsection