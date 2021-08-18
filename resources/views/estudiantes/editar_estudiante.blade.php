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
			Perfil | {{$profesor->nombre}} {{$profesor->apellido_p}} {{$profesor->apellido_m}}
		</h3>

		<span class="kt-subheader__separator kt-subheader__separator--v"></span>

		<div class="kt-subheader__group" id="kt_subheader_search">
			<span class="kt-subheader__desc" id="kt_subheader_total">
				Profesor
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
			<form action="{{route('profesor_update',$profesor->id)}}" method="post" enctype="multipart/form-data">
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

												<h3 class="kt-section__title kt-section__title-sm">Perfil del profesor:</h3>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
											<div class="col-lg-9 col-xl-6">
												<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
													{!!$errors->first('foto', '<small style="color:red">:message</small>')!!}
													<div class="kt-avatar__holder" style="background-image: url(&quot;{{$profesor->foto}}&quot;);"></div>
													<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
														<i class="fa fa-pen"></i>
														<input type="file" name="foto" accept=".png, .jpg, .jpeg">
													</label>
													<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
														<i class="fa fa-times"></i>
													</span>
												</div>
											</div>
										</div>

										<div class="form-group row">

											<label class="col-xl-3 col-lg-3 col-form-label">Nombres del profesor</label>

											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('nombre', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$profesor->nombre}}" name="nombre">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Apellido paterno</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('apellido_p', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$profesor->apellido_p}}" name="apellido_p">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Apellido materno</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('apellido_m', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$profesor->apellido_m}}" name="apellido_m">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Rut del profesor</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('rut', '<small style="color:red">:message</small>')!!}
												<input class="form-control" type="text" value="{{$profesor->rut}}" placeholder="Rut sin . -" name="rut" id="rut" oninput="isValidRUT(value)" maxlength="12">
											</div>
										</div>

										<div class="form-group form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Fecha de nacimiento</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('fecha_nacimiento', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<input type="date" class="form-control" placeholder="Username" value="{{ \Carbon\Carbon::parse($profesor->fecha_nacimiento)->format('Y-m-d')}}" name="fecha_nacimiento">
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Numero de telefono</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('telefono', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
													<input type="number" class="form-control" value="{{$profesor->telefono}}" placeholder="Telefono" aria-describedby="basic-addon1" name="telefono">
												</div>

											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Correo electronico</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('email', '<small style="color:red">:message</small>')!!}
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
													<input type="email" class="form-control" value="{{$profesor->email}}" placeholder="exampled@gmail.com" aria-describedby="basic-addon1" name="email">
												</div>
											</div>
										</div>

										<div class="row">
											<label class="col-xl-3"></label>
											<div class="col-lg-9 col-xl-6">
												<h3 class="kt-section__title kt-section__title-sm">Direccion del profesor:</h3>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Region</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('region_provincia_comuna', '<small style="color:red">:message</small>')!!}
												<select class="form-control" name="region" id="region">
													<option value="0" selected disabled>Seleccione región</option>
													@foreach($regiones as $region)
													@if($region->id == $profesor->id_region)
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
													@if($provincia->id == $profesor->id_provincia)
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
													@if($comuna->id == $profesor->id_comuna)
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
													<input type="text" class="form-control" value="{{$profesor->direccion}}" placeholder="" aria-describedby="basic-addon1" name="direccion">
												</div>
											</div>
										</div>

										<div class="row">
											<label class="col-xl-3"></label>
											<div class="col-lg-9 col-xl-6">
												<h3 class="kt-section__title kt-section__title-sm">Tipo de profesor:</h3>

											</div>

										</div>
										<div class="form-group form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Profesor</label>
											<div class="col-lg-9 col-xl-6">
												{!!$errors->first('tipo_profesor', '<small style="color:red">:message</small>')!!}
												<select class="form-control" name="tipo_usuario">
													<option value="0" disabled>Seleccione el tipo de profesor</option>
													@if($profesor->id_tipo_usuario == 2)
													<option value="2" selected>Profesor</option>
													<option value="3">Ayudante</option>
													@else
													<option value="2">Profesor</option>
													<option value="3" selected>Ayudante</option>
													@endif
												</select>

											</div>
										</div>

										<div class="form-group form-group-last row">
											<label class="col-xl-3 col-lg-3 col-form-label">Materia especifica (opcional)</label>
											<div class="col-lg-9 col-xl-6">
												
												<select class="form-control" name="tipo_profesor">
													<option value="0" >Seleccione materia especifica</option>
													@foreach($tipo_profesores as $tipo)
													@if($tipo->id_materia!= 1)
													@if($tipo->id_materia == $profesor->id_materia)
													<option value="{{$tipo->id_materia}}" selected>{{$tipo->materia}}</option>
													@else
													<option value="{{$tipo->id_materia}}">{{$tipo->materia}}</option>
													@endif
													@endif
													@endforeach
												</select>

											</div>
										</div>

										<div class="d-flex justify-content-between border-top pt-10 mt-15" style="margin:20px">
											<div class="mr-2"></div>
											<div>
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
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script>
	$(document).ready(function() {

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