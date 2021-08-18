@extends('layout.layout')

@section('head')
<div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Inicio
        </h3>
    </div>
</div>


@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="card-body" style="position: relative;">
            <!--begin::Chart-->
           <div class="chart">
               <div id="apexchartsfc3noor2" class="apexcharts-canvas apexchartsfc3noor2 apexcharts-theme-light">

               </div>
           </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>
@endsection