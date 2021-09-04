@extends('layout.layout')

@section('titulo')
Inicio Administrador | Escuela Chile España
@endsection

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
    <div class="row">

        <div class="col-md-8">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Total de Archivos
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                    <div id="chart2" style="min-height: 247.7px;">

                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Total de Usuarios
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                    <div id="chart" style="min-height: 247.7px;">

                    </div>


                </div>
            </div>
        </div>





    </div>
</div>


@endsection

@section('js')
<script src="{{asset('assets/js/demo1/pages/components/charts/apexcharts.js')}}"></script>
<script>
    var options = {
        series: [<?php echo $profesores ?>, <?php echo $ayudantes ?>, <?php echo $estudiantes ?>],
        chart: {
            width: 380,
            type: 'donut',
            dropShadow: {
                enabled: true,
                color: '#111',
                top: -1,
                left: 3,
                blur: 3,
                opacity: 0.2
            }
        },
        stroke: {
            width: 0,
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true
                        }
                    }
                }
            }
        },
        labels: ["Profesores", "Coeducadores", "Estudiantes"],
        dataLabels: {
            dropShadow: {
                blur: 3,
                opacity: 0.8
            }
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
<!-- 21, 22, 10, 28, 16, 21, 13, 30 -->
<script>
    var array = [21, 22, 10, 28, 16, 21, 13, 30];

    var nombres = <?php echo json_encode($nombres);?>;
    var cont_archivos = <?php echo json_encode($archivos);?>;
    console.log(cont_archivos);


    var options = {
        series: [{
            data: cont_archivos
        }],
        chart: {
            height: 350,
            type: 'bar',
            events: {
                click: function(chart, w, e) {
                    // console.log(chart, w, e)
                }
            }
        },

        plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: nombres,
            labels: {
                style: {

                    fontSize: '12px'
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
    
</script>
<script>
    
    $('#inicio').addClass('kt-menu__item--active');
    /*  */
    $('#atras').hide()
</script>
<script src="{{asset('assets/js/demo1/pages/dashboard.js')}}" type="text/javascript"></script>

@endsection