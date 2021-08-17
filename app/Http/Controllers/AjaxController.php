<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function tipo_usuario(Request $request)
    {


        if ($request->id_tipo == 1) {
            $html = "";
        } elseif ($request->id_tipo == 2) {

            $html = "<h5 class='text-dark font-weight-bold mb-10 mt-5'>Foto Profesor</h5>";
            $html = $html . "<div class='form-group row fv-plugins-icon-container'>";
            $html = $html . "<div class='col-lg-9 col-xl-9'>
                            <input class='form-control form-control-solid form-control-lg' name='foto' type='file' accept='image/*'>
                            <div class='fv-plugins-message-container'></div></div>
                        </div>";
        } elseif ($request->id_tipo == 3) {
            $html = "<h5 class='text-dark font-weight-bold mb-10 mt-5'>Apoderado</h5>";
            $html = $html . "<div class='form-group row fv-plugins-icon-container'>";
            $html = $html . "<label class='col-xl-3 col-lg-3 col-form-label'>Nombres del Apoderado</label>";
            $html = $html . "<div class='col-lg-9 col-xl-9'>
                            <input class='form-control form-control-solid form-control-lg' name='name_apoderado' type='text' value=''>
                            <div class='fv-plugins-message-container'></div></div>
                        </div>";
            $html = $html . '<div class="form-group row fv-plugins-icon-container">
                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido Paterno Apoderado</label>
                            <div class="col-lg-9 col-xl-9">
                            <input class="form-control form-control-solid form-control-lg" name="apellido_p_a" type="text" value="">
                            <div class="fv-plugins-message-container"></div></div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row fv-plugins-icon-container">
                            <label class="col-xl-3 col-lg-3 col-form-label">Apellido Materno Apoderado</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-solid form-control-lg" name="apellido_m_a" type="text" value="">
                                <div class="fv-plugins-message-container"></div></div>
                        </div>';
            $html = $html . '<div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">Rut del apoderado</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-solid form-control-lg" name="rut_apoderado" type="text" placeholder="11.111.111-1">
                                <div class="fv-plugins-message-container"></div></div>
                            </div>
                            <!--end::Group-->
                            <!--begin::Group-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">Número del apoderado</label>
                                <div class="col-lg-9 col-xl-9">
                                <div class="input-group input-group-solid input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="la la-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-solid form-control-lg" name="phone_apoderado" placeholder="Teléfono" >
                                </div>
                                <div class="fv-plugins-message-container"></div></div>
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
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="email_apoderado" placeholder="Correo" value="">
                                    </div>
                                <div class="fv-plugins-message-container"></div></div>
                            </div>
                            <!--end::Group-->
                            <!--begin::Group-->
                            <!--end::Group-->';
            $html = $html . '<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                <h5 class="text-dark font-weight-bold mb-10">Diagnóstico:</h5>
                                <div class="form-group ">
                                    <select class="form-control form-control-lg form-control-solid" name="diagnostico" id="tipo_user">
                                    <option value="0" selected disabled>Seleccione diagnóstico/s del estudiante</option>											
							        </select>
                                </div>
                            </div>';
        } else {
            $html = "";
        }

        echo $html;
    }

    public function select_ayudante(Request $request)
    {
        $profesores = DB::table('users')->select('id', 'nombre', 'apellido_p', 'apellido_m')->where('id', '!=', $request->id_profesor)->where('id_tipo_usuario', 2)->get();
        $html = "<option value='0' selected disabled>Seleccione profesor</option>";

        foreach ($profesores as $profesor) {

            $html = $html . "<option value=" . $profesor->id . ">" . $profesor->nombre . "</option>";
        }

        echo $html;
    }

    public function equipo_docente(Request $request)
    {
        $profesores = DB::table('users')->where('id_tipo_usuario',2)->get();
        $ayudantes = DB::table('users')->where('id_tipo_usuario',3)->get();

        $html = '<h4 style="margin-left:1%">Profesores</h4>
        <div class="container row">';
        foreach($profesores as $profesor){
            $html = $html.' <div class="kt-widget__item" style="margin-left:1%">
                                <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">

                                    <div class="kt-avatar__holder" style="background-image: url(&quot;'. $profesor->foto.'&quot;);"></div>
                                </div>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <p style="text-align: center;">'.$profesor->nombre.' </p>
                                    </div>
                                    <span class="kt-widget__desc">
                                        <p style="text-align: center;">'.$profesor->apellido_p.' '.$profesor->apellido_m.'</p>
                                    </span>
                                </div>
                            </div>';
        }

        $html = $html.'</div>
        <h4 style="margin-left:1%">Coeducadores</h4>
        <div class="container row">';
        foreach($ayudantes as $profesor){
            $html=$html.'<div class="kt-widget__item" style="margin-left:1%">
            <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">

                <div class="kt-avatar__holder" style="background-image: url(&quot;'.$profesor->foto.'&quot;);"></div>

            </div>
            <div class="kt-widget__info">
                <div class="kt-widget__section">
                    <p style="text-align: center;">'.$profesor->nombre.'</p>

                </div>

                <span class="kt-widget__desc">
                    <p style="text-align: center;">'.$profesor->apellido_p.' '.$profesor->apellido_m.'</p>
                </span>
            </div>
        </div>';
        }
        $html = $html.'</div>';
       

       

       
        echo $html;
    }
}
