@extends('layout.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .xd{
        background-color: pink;
    }

</style>
@endsection

@section('head')
<div class="container-fluid d-flex align-self-center flex-wrap flex-sm-nowrap " >
    <div class="col ">
        <h4 class="font-weight-bold  ">Nuevo Usuario</h4>
    </div>
</div>

@endsection

@section('content')
    <div class="card card-custom card-shadowless rounded-top-0">
    <div class="card-body p-0">
    

    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="row justify-content-center">
			<div class="col-xl-9">
			{!!$errors->first('estado', '<small>:message</small>')!!}
			    <!--begin::Wizard Step 1-->
                    <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
					
                        <h5 class="text-dark font-weight-bold mb-10">Tipo de usuario:</h5>
                        <div class="form-group">
                            <select class="form-control form-control-lg form-control-solid" name="tipo_user" id="tipo_user" required>
                                <option value="0" selected disabled>Seleccione el tipo de usuario</option>
                                @foreach($tipo_usuarios as $tipo)
                                    <option value="{{$tipo->id_tipo_user}}">{{$tipo->tipo_user}}</option>
                                @endforeach												
							</select>
                        </div>
						
                    </div>
                    <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
					    <h5 class="text-dark font-weight-bold mb-10">Datos del usuario:</h5>
						<!--begin::Group-->
						<!-- <div class="form-group row">
							<label class="col-xl-3 col-lg-3 col-form-label text-left">Avatar</label>
							<div class="col-lg-9 col-xl-9">
								<div class="image-input image-input-outline" id="kt_user_add_avatar">
									<div class="image-input-wrapper" style="background-image: url(/metronic/theme/html/demo1/dist/assets/media/users/100_6.jpg)"></div>
									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
										<input type="hidden" name="profile_avatar_remove">
									</label>
						            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
							            <i class="ki ki-bold-close icon-xs text-muted"></i>
						            </span>
					            </div>
				            </div>
			            </div> -->
						<!--end::Group-->
                        
						<!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Nombres del usuario</label>
							<div class="col-lg-9 col-xl-9">
								<input class="form-control form-control-solid form-control-lg" name="name" type="text" value="{{old('name')}}">
							<div class="fv-plugins-message-container">
								{!!$errors->first('name', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
						<!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Apellido Paterno</label>
							<div class="col-lg-9 col-xl-9">
								<input class="form-control form-control-solid form-control-lg" name="apellido_paterno" type="text" value="{{old('apellido_paterno')}}">
							<div class="fv-plugins-message-container">
								{!!$errors->first('apellido_paterno', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
                        <!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Apellido Materno</label>
							<div class="col-lg-9 col-xl-9">
								<input class="form-control form-control-solid form-control-lg" name="apellido_materno" type="text" value="{{old('apellido_materno')}}">
							<div class="fv-plugins-message-container">
								{!!$errors->first('apellido_materno', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
						<!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Rut del usuario</label>
							<div class="col-lg-9 col-xl-9">
								<input class="form-control form-control-solid form-control-lg" name="rut" type="text" placeholder="11.111.111-1" value="{{old('rut')}}" id="rut"
								oninput="isValidRUT(value)" > 
							<div class="fv-plugins-message-container">
							{!!$errors->first('rut', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
						<!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Número de Contacto</label>
							<div class="col-lg-9 col-xl-9">
								<div class="input-group input-group-solid input-group-lg">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-phone"></i>
										</span>
									</div>
									<input type="text" class="form-control form-control-solid form-control-lg" name="phone" placeholder="Teléfono" value="{{old('phone')}}">
								</div>
							<div class="fv-plugins-message-container">
							{!!$errors->first('phone', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
						<!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Correo electrónico</label>
							<div class="col-lg-9 col-xl-9">
								<div class="input-group input-group-solid input-group-lg">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-at"></i>
										</span>
									</div>
									<input type="text" class="form-control form-control-solid form-control-lg" name="email" placeholder="Correo" value="{{old('email')}}">
								</div>
							<div class="fv-plugins-message-container">
							{!!$errors->first('email', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
						<!--begin::Group-->
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Fecha de nacimiento</label>
							<div class="col-lg-9 col-xl-9">
								<div class="input-group input-group-solid input-group-lg">
									<input type="date" class="form-control form-control-solid form-control-lg" name="fecha_nacimiento" style="width:200px" value="{{old('fecha_nacimiento')}}">
								</div>
							<div class="fv-plugins-message-container">
							{!!$errors->first('fecha_nacimiento', '<small>:message</small>')!!}
							</div></div>
						</div>
						<!--end::Group-->
					</div>
					<!--end::Wizard Step 1-->
					<!--begin::Wizard Step 2-->
					<div class="my-5 step" data-wizard-type="step-content" id="div-detalle">
						
						<!--begin::Group-->
						
							
						
						<!--end::Group-->
					</div>
					<!--end::Wizard Step 2-->
					<!--begin::Wizard Step 3-->
					<div class="my-5 step" data-wizard-type="step-content">
						<h5 class="mb-10 font-weight-bold text-dark">Direccion del usuario:</h5>
						<!--begin::Group-->
						<div class="form-group fv-plugins-icon-container">
							<label>Región</label>
                           
                            <select class="form-control form-control-lg form-control-solid" name="region" id="region" >
                                    <option value="0" selected disabled>Seleccione región</option>
                                    @foreach($regiones as $region)
                                    <option value="{{$region->id}}">{{$region->region}}</option>
                                    @endforeach
                            </select>
						<div class="fv-plugins-message-container"></div></div>
						<!--end::Group-->
						<!--begin::Row-->
						<div class="row">
							
								<!--begin::Group-->
								<div class="form-group fv-plugins-icon-container">
									<label>Provincia</label>
									<select class=" form-control form-control-lg form-control-solid" name="provincia"id="provincia"></select>
								<div class="fv-plugins-message-container"></div></div>
							
							<!--end::Group-->
							<!--begin::Group-->
							<div class="col-xl-6">
								<div class="form-group fv-plugins-icon-container">
									<label>Comuna</label>
									<select class=" form-control form-control-lg form-control-solid" name="comuna"id="comuna"></select>
								<div class="fv-plugins-message-container"></div></div>
							</div>
							<!--end::Group-->
						</div>
                        <div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Dirección</label>
							<div class="col-lg-9 col-xl-9">
								<div class="input-group input-group-solid input-group-lg">
									<input type="text" class="form-control form-control-solid form-control-lg" name="direccion"  value="{{old('direccion')}}">
								</div>
							<div class="fv-plugins-message-container">
							{!!$errors->first('direccion', '<small>:message</small>')!!}
							</div></div>
						</div>
                    </div>

					<!--end::Wizard Step 3-->
					<!--begin::Wizard Actions-->
					<div class="d-flex justify-content-between border-top pt-10 mt-15">
						<div class="mr-2"></div>
						<div>
							<button type="submit" class="btn btn-success font-weight-bolder px-9 py-4"   style="margin:20px">Registrar</button>
						</div>
					</div>
					<!--end::Wizard Actions-->
				</div>
			</div>
        
        
    </form>
    </div>
    </div>
    



@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">     
	
</script>
<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script>
$(document).ready(function() {
	
	document.getElementById("rut").oninput = function isValidRUT(rut) {
		var rut =document.getElementById("rut");
		console.log(rut.value);
		
		rut.value = rut.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
    }
		
		
	

	
    $('.select2').select2();
    $('#region').change(function(){
        var id_region=$("#region").val();
        $.ajax({
                data:  {
                    id_region,
                    _token:$('input[name="_token"]').val()
                    },
                url:   "{{route('region.provincia')}}",
                type:  "POST",
                beforeSend: function () { },
                success:  function (response) {                	
                    $("#provincia").html(response);
                },
                error:function(){
                	alert("error")
                }
            });
        $('#comuna').empty();
    });

    $('#provincia').change(function(){
        var id_provincia=$("#provincia").val();
        $.ajax({
                data:  {
                    id_provincia,
                    _token:$('input[name="_token"]').val()
                    },
                url:   "{{route('provincia.comuna')}}",
                type:  "POST",
                beforeSend: function () { },
                success:  function (response) {                	
                    $("#comuna").html(response);
                },
                error:function(){
                	alert("error")
                }
            });
    });
});
</script>

<script>
    $('#tipo_user').change(function(){
            var id_tipo=$("#tipo_user").val();
            $.ajax({
                    data:  {
                        id_tipo,
                        _token:$('input[name="_token"]').val()
                        },
                    url:   "{{route('tipo_usuario')}}",
                    type:  "POST",
                    beforeSend: function () { },
                    success:  function (response) {                	
                        $("#div-detalle").html(response);
                    },
                    error:function(){
                        alert("error")
                    }
                });
        });

</script>
@endsection