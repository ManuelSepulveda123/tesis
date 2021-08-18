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

<script src="./assets/js/demo1/pages/components/charts/apexcharts.js" type="text/javascript"></script>

<script>
    var options = {
        series: [44, 55, 41, 17, 15],
        chart: {
            type: 'donut',
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection