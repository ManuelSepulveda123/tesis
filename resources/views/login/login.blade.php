<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!-- begin::Head -->

<head>
	<!--begin::Base Path (base relative path for assets of this page) -->
	<base href="../../../../">
	<!--end::Base Path -->
	<meta charset="utf-8" />

	<title>Escuela Chile España | Login </title>
	<meta name="description" content="Login page example">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
	<!--end::Fonts -->


	<!--begin::Page Custom Styles(used by this page) -->
	<link href="{{asset('assets/css/demo1/pages/login/login-1.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="{{asset('assets/vendors/global/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/demo1/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->

	<!--begin::Layout Skins(used by all pages) -->

	<link href="{{asset('assets/css/demo1/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/demo1/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/demo1/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/demo1/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Layout Skins -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link href="{{asset('assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/quill/dist/quill.snow.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/@yaireo/tagify/dist/tagify.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/dual-listbox/dist/dual-listbox.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="{{URL::asset('assets/media/Escuela/icon.png')}}" />
</head>
<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">


	<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
				<!--begin::Aside-->
				<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{asset('assets/media/Escuela/login.jpg')}});">
					<div class="kt-grid__item">
						<a href="#" class="kt-login__logo">
							<img src="{{asset('assets/media/Escuela/escuela-espana-228x300.png')}}" width="30%" height="30%">
						</a>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
						<div class="kt-grid__item kt-grid__item--middle">
							<h3 class="kt-login__title">Escuela Chile España</h3>
							<h4 class="kt-login__subtitle"><b>Somos una escuela que avanza hacia la inclusión educativa y social, por medio de procesos de construcción colectiva que fomenten la participación activa de las comunidades y del entorno local, en beneficio de los procesos educativos que se desarrollan en nuestra escuela.</b> </h4>
						</div>
					</div>
					<div class="kt-grid__item">
						<div class="kt-login__info">
							<div class="kt-login__copyright">

							</div>
							<div class="kt-login__menu">
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2" style="color:black">
									Equipo
								</button>

								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" style="color:black">
									Contacto
								</button>
								<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Contacto</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div id="seed-csp4-description">
													<p style="text-align: center;">Si necesita contactarse con nosotros,<br>
														llámenos al teléfono +56 9 8740 3638 o al +56 9 4481 7316</p>
													<p style="text-align: center;"><a href="mailto:e.chileespana@educacionpublica.cl">e.chileespana@educacionpublica.cl</a></p>
													<p style="text-align: center;">Av. Pedro de Valdivia 651<br>
														Concepción, Chile</p>
													<div class="_2pi9 _2pi2">
														<div class="clearfix _ikh">
															<div class="_4bl7" style="text-align: center;"><a href="https://goo.gl/maps/nBhdm8uWZxuXqRQr8" target="_Blank">Ubicación</a></div>
														</div>
													</div>
													<p>
														<!--more-->
													</p>
													<div class="_2pi9 _2pi2">
														<div class="clearfix _ikh">
															<div class="_4bl7 " style="text-align: center;">
																<a href="https://www.facebook.com/EscuelaEspecialChileEspana/?ref=page_internal" target="_Blank">Facebook</a>
																<span class="">|</span>
																<a href="https://www.instagram.com/escuela.chileespana/?fbclid=IwAR1TBv-B50G60wEBjmoPb4iG8Syfhuth5mu-XzhBgAmoonpr9sC7-ePuQi8" target="_Blank">Instragram</a>
															</div>
														</div>
													</div>

												</div>
											</div>


											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

											</div>
										</div>
									</div>
								</div>
								<!-- Modal equipo docente -->

								<div class="modal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel2">Equipo Docente</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div id="seed-csp4-description">
													<h4 style="margin-left:1%">Profesores</h4>
													<div class="container row">

														@foreach($profesores as $profesor)
														<div class="kt-widget__item" style="margin-left:1%">
															<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">

																<div class="kt-avatar__holder" style="background-image: url(&quot;{{$profesor->foto}}&quot;);"></div>

															</div>
															<div class="kt-widget__info">
																<div class="kt-widget__section">
																	<p style="text-align: center;">{{$profesor->nombre}} </p>

																</div>

																<span class="kt-widget__desc">
																	<p style="text-align: center;">{{$profesor->apellido_p}} {{$profesor->apellido_m}}</p>
																</span>
															</div>
														</div>

														@endforeach
													</div>
													<h4 style="margin-left:1%">Coeducadores</h4>
													<div class="container row">

														@foreach($ayudantes as $profesor)
														<div class="kt-widget__item" style="margin-left:1%">
															<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">

																<div class="kt-avatar__holder" style="background-image: url(&quot;{{$profesor->foto}}&quot;);"></div>

															</div>
															<div class="kt-widget__info">
																<div class="kt-widget__section">
																	<p style="text-align: center;">{{$profesor->nombre}} </p>

																</div>

																<span class="kt-widget__desc">
																	<p style="text-align: center;">{{$profesor->apellido_p}} {{$profesor->apellido_m}}</p>
																</span>
															</div>
														</div>
														@endforeach
													</div>
												</div>
											</div>


											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--begin::Aside-->

				<!--begin::Content-->
				<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
					<!--begin::Head-->
					<!-- <div class="kt-login__head">
				<span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
				<a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>
			</div> -->
					<!--end::Head-->

					<!--begin::Body-->
					<div class="kt-login__body">

						<!--begin::Signin-->
						<div class="kt-login__form">
							<div class="kt-login__title">
								<h3>Ingrese sus datos</h3>
							</div>

							<!--begin::Form-->


							<form class="kt-form" action="{{route('login_validar')}}" method="post" novalidate="novalidate" id="kt_login_form">
								@csrf
								@include('flash::message')
								<div class="form-group">
									<input class="form-control" type="email" placeholder="Correo" name="email" value="{{old('email')}}">
									{!!$errors->first('email', '<small>:message</small>')!!}
								</div>
								<div class="form-group">
									<input class="form-control" type="password" placeholder="Contraseña" name="password" autocomplete="off">
									{!!$errors->first('password', '<small>:message</small>')!!}
								</div>
								<!--begin::Action-->
								<div class="kt-login__actions">

									<a href="" data-toggle="modal" data-target="#password" class="kt-link kt-login__link-forgot">
										¿Olvido su contraseña?
									</a>

									<button id="kt_login_signin_submit" class="btn btn-warning btn-elevate kt-login__btn-primary">
										<h4>iniciar sesión</h4>
									</button>


									<!--end::Action-->
							</form>
							<div class="modal " id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Estudiante</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">
											<form action="{{route('cambio_contra')}}" class="kt-form" method="POST">
												@csrf
												<div class="form-group">
													<input class="form-control" type="email" placeholder="Correo" name="email" value="">

												</div>
												<div class="kt-login__actions">
													<button class="btn btn-success" style="width: 100%;">
														<h4>Enviar Correo</h4>
													</button>
												</div>
											</form>

											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Content-->
			</div>
		</div>
	</div>

	<!-- end:: Page -->


	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {
			"colors": {
				"state": {
					"brand": "#5d78ff",
					"dark": "#282a3c",
					"light": "#ffffff",
					"primary": "#5867dd",
					"success": "#34bfa3",
					"info": "#36a3f7",
					"warning": "#ffb822",
					"danger": "#fd3995"
				},
				"base": {
					"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
					"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
				}
			}
		};
	</script>

	<script>
		$('#exampleModal').on('shown.bs.modal', function() {
			console.log("#AS")
			$('#myInput').trigger('focus')
		})
	</script>
	<!-- end::Global Config -->

	<!--begin::Global Theme Bundle(used by all pages) -->
	<script src="{{asset('assets/vendors/global/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>
	<!--end::Global Theme Bundle -->


	<!--begin::Page Scripts(used by this page) -->
	<script src="{{asset('assets/js/demo1/pages/login/login-1.js')}}" type="text/javascript"></script>
	<!--end::Page Scripts -->
	<script src="{{asset('assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>

	<script src="{{asset('assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>
</body>
<!-- end::Body -->

</html>