@extends('layout.layout')
@section('titulo')
Editar Estudiantes | Escuela Chile España
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('head')
<div class="kt-container  kt-container--fluid ">
	<div class="kt-subheader__main">

		<h3 class="kt-subheader__title">
			{{$estudiante->nombre}} {{$estudiante->apellido_p}} {{$estudiante->apellido_m}}
		</h3>

		<span class="kt-subheader__separator kt-subheader__separator--v"></span>

		<div class="kt-subheader__group" id="kt_subheader_search">
			<span class="kt-subheader__desc" id="kt_subheader_total">
				Perfil
			</span>

		</div>
	</div>
</div>

@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--tabs">

		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Datos del Estudiante
				</h3>
			</div>
		</div>

		<div class="kt-portlet__body">
			@include('flash::message')
			<form action="{{route('estudiantes_update',$estudiante->id)}}" method="post" enctype="multipart/form-data">
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
												<h3 class="kt-section__title kt-section__title-sm">Detalles del estudiante:</h3>
											</div>
										</div>
										<div class="form-group row">

											<label class="col-xl-3 col-lg-3 col-form-label">Nombres del estudiante</label>

											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$estudiante->nombre}}" name="nombre">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Apellido paterno</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('apellido_p', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$estudiante->apellido_p}}" name="apellido_p">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Apellido materno</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('apellido_m', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$estudiante->apellido_m}}" name="apellido_m">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Rut del profesor</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('rut', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$estudiante->rut}}" placeholder="Rut sin . -" name="rut" id="rut" oninput="isValidRUT(value)" maxlength="12">
											</div>
										</div>

										<div class="form-group form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Fecha de nacimiento</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('fecha_nacimiento', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<input type="date" class="form-control" placeholder="Username" value="{{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('Y-m-d')}}" name="fecha_nacimiento">
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Numero de telefono</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('telefono', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
													<input type="number" class="form-control" value="{{$estudiante->telefono}}" placeholder="Telefono" aria-describedby="basic-addon1" name="telefono">
												</div>

											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Correo electronico</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('email', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
													<input type="email" class="form-control" value="{{$estudiante->email}}" placeholder="exampled@gmail.com" aria-describedby="basic-addon1" name="email">
												</div>
											</div>
										</div>

										<div class="row">
											<label class="col-xl-3"></label>
											<div class="col-lg-9 col-xl-6">
												<h3 class="kt-section__title kt-section__title-sm">Direccion del estudiante:</h3>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Region</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('region_provincia_comuna', '<small style="color:red">:message</small>')!!}
												<select class="form-control" name="region" id="region">
													<option value="0" selected disabled>Seleccione región</option>
													@foreach($regiones as $region)
													@if($region->id == $estudiante->id_region)
													<option value="{{$region->id}}" selected>{{$region->region}}</option>
													@else
													<option value="{{$region->id}}">{{$region->region}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Provincia</label>
											<div class="col-lg-9 col-xl-6">
												<select class="form-control" name="provincia" id="provincia">
													<option value="0" disabled>Seleccione provincia</option>
													@foreach($provincias as $provincia)
													@if($provincia->id == $estudiante->id_provincia)
													<option value="{{$provincia->id}}" selected>{{$provincia->provincia}}</option>
													@else
													<option value="{{$provincia->id}}">{{$provincia->provincia}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Comuna</label>
											<div class="col-lg-9 col-xl-6">
												<select class="form-control" name="comuna" id="comuna">
													<option value="0" disabled>Seleccione comuna</option>
													@foreach($comunas as $comuna)
													@if($comuna->id == $estudiante->id_comuna)
													<option value="{{$comuna->id}}" selected>{{$comuna->comuna}}</option>
													@else
													<option value="{{$comuna->id}}">{{$comuna->comuna}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="form-group form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Direccion</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('direccion', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<input type="text" class="form-control" value="{{$estudiante->direccion}}" placeholder="" aria-describedby="basic-addon1" name="direccion">
												</div>
											</div>
										</div>

										<div class="row">
											<label class="col-xl-3"></label>
											<div class="col-lg-9 col-xl-6">
												<h3 class="kt-section__title kt-section__title-sm">Curso del estudiante:</h3>

											</div>

										</div>

										<div class="form-group form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Curso</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('curso', '<small style="color:red">:message</small>')!!}
												<select class="form-control" name="curso">
													<option value="0" disabled selected>Seleccione un curso</option>

													@foreach($cursos as $curso)
													@if($curso->id_curso == $curso_estudiante->id_curso)
													<option value="{{$curso->id_curso}}" selected>{{$curso->curso}} | {{ \Carbon\Carbon::parse($curso->ano_curso)->format('Y')}}</option>
													@else
													<option value="{{$curso->id_curso}}">{{$curso->curso}} | {{ \Carbon\Carbon::parse($curso->ano_curso)->format('Y')}}</option>
													@endif
													@endforeach
												</select>

											</div>
										</div>

										<div class="row">
											<label class="col-xl-3"></label>
											<div class="col-lg-9 col-xl-6">
												<h3 class="kt-section__title kt-section__title-sm">Diagnostico del estudiante:</h3>

											</div>

										</div>

										<div class="form-group form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Diagnostico</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('diagnostico', '<small style="color:red">:message</small>')!!}
												<select class="form-control" name="diagnostico">
													<option value="0" selected>Seleccione un diagnostico</option>
													@foreach($diagnosticos as $diagnostico)
													@if($diagnostico_estudiante->id_diagnostico == $diagnostico->id)
													<option value="{{$diagnostico->id}}" selected>{{$diagnostico->diagnostico}}</option>
													@else
													<option value="{{$diagnostico->id}}">{{$diagnostico->diagnostico}}</option>
													@endif
													@endforeach
												</select>

											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Otro</label>
											<div class="col-lg-9 col-xl-6">

												<input class="form-control" type="text" value="{{$diagnostico_estudiante->otro}}" name="otro">
											</div>
										</div>




										<div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
											<div class="mr-2"></div>
											<div>
												<a href="" data-toggle="modal" data-target="#cambio" class="btn btn-dark px-9 py-4">Cambiar Contraseña</a>
												<button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Guardar</button>
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

	<div class="modal" id="cambio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cambio de Contraseña</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{route('password_update',$estudiante->id)}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<div class="form-group row">
							<label class=" col-form-label" style="margin-right:10px">Nueva Contraseña </label>
							<div class="" style="text-align: center;">

								<input class="form-control" type="text" value="" name="nueva_password">
							</div>
						</div>


					</div>
					<button type="submit" class="btn btn-success" style="margin:20px">Guardar Contraseña</button>

					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="kt-portlet kt-portlet--tabs">

		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Datos del Apoderado
				</h3>
			</div>
		</div>

		<div class="kt-portlet__body">

			<div class="form-group ">
				<label class="col-xl-1 col-lg-12 col-form-label"></label>
				<label class="col-xl-4 col-lg-4 col-form-label"><b>Nombres del apoderado:</b> {{$apoderado->nombre}} {{$apoderado->apellido_p}} {{$apoderado->apellido_m}}</label>
				<label class="col-xl-6 col-lg-6 col-form-label"><b>Rut:</b> {{$apoderado->rut}}</label>

			</div>
			<div class="form-group ">
				<label class="col-xl-1 col-lg-12 col-form-label"></label>
				<label class="col-xl-4 col-lg-4 col-form-label"><b>Correo:</b> {{$apoderado->email}} </label>
				<label class="col-xl-6 col-lg-6 col-form-label"><b>Telefono:</b> {{$apoderado->telefono}}</label>

			</div>
		</div>
	</div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script>
	$(document).ready(function() {
		$('#administrador_nav').addClass('kt-menu__item--open');
		$('#tabla_estudiantes').addClass('kt-menu__item--active');
		document.getElementById("rut").oninput = function isValidRUT(rut) {
			var rut = document.getElementById("rut");
			console.log(rut.value);

			rut.value = rut.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
		}


		$('.select2').select2();
		$('#region').change(function() {
			var id_region = $("#region").val();
			$.ajax({
				data: {
					id_region,
					_token: $('input[name="_token"]').val()
				},
				url: "{{route('region.provincia')}}",
				type: "POST",
				beforeSend: function() {},
				success: function(response) {
					$("#provincia").html(response);
				},
				error: function() {
					alert("error")
				}
			});
			$('#comuna').empty();
		});

		$('#provincia').change(function() {
			var id_provincia = $("#provincia").val();
			$.ajax({
				data: {
					id_provincia,
					_token: $('input[name="_token"]').val()
				},
				url: "{{route('provincia.comuna')}}",
				type: "POST",
				beforeSend: function() {},
				success: function(response) {
					$("#comuna").html(response);
				},
				error: function() {
					alert("error")
				}
			});
		});
	});
</script>
<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/demo1/pages/custom/user/edit-user.js')}}" type="text/javascript"></script>
<script>
	$('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>

@endsection