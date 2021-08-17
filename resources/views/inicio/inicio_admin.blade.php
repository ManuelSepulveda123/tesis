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
            <div id="chart" style="min-height: 138.466px;">
                <div id="apexchartsfc3noor2" class="apexcharts-canvas apexchartsfc3noor2 apexcharts-theme-light" style="width: 200px; height: 138.466px;"><svg id="SvgjsSvg1307" width="200" height="138.46646118164062" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                        <foreignObject x="0" y="0" width="200" height="138.46646118164062">
                            <div class="apexcharts-legend apexcharts-align-center position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 1px; position: absolute; max-height: 83.3333px;">
                                <div class="apexcharts-legend-series" rel="1" seriesname="seriesx1" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(0, 143, 251) !important; color: rgb(0, 143, 251); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="series-1" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">series-1</span></div>
                                <div class="apexcharts-legend-series" rel="2" seriesname="seriesx2" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(0, 227, 150) !important; color: rgb(0, 227, 150); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="series-2" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">series-2</span></div>
                                <div class="apexcharts-legend-series" rel="3" seriesname="seriesx3" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgb(254, 176, 25) !important; color: rgb(254, 176, 25); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="series-3" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">series-3</span></div>
                                <div class="apexcharts-legend-series" rel="4" seriesname="seriesx4" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="4" data:collapsed="false" style="background: rgb(255, 69, 96) !important; color: rgb(255, 69, 96); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="4" i="3" data:default-text="series-4" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">series-4</span></div>
                                <div class="apexcharts-legend-series" rel="5" seriesname="seriesx5" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="5" data:collapsed="false" style="background: rgb(119, 93, 208) !important; color: rgb(119, 93, 208); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="5" i="4" data:default-text="series-5" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">series-5</span></div>
                            </div>
                            <style type="text/css">
                                .apexcharts-legend {
                                    display: flex;
                                    overflow: auto;
                                    padding: 0 10px;
                                }

                                .apexcharts-legend.position-bottom,
                                .apexcharts-legend.position-top {
                                    flex-wrap: wrap
                                }

                                .apexcharts-legend.position-right,
                                .apexcharts-legend.position-left {
                                    flex-direction: column;
                                    bottom: 0;
                                }

                                .apexcharts-legend.position-bottom.apexcharts-align-left,
                                .apexcharts-legend.position-top.apexcharts-align-left,
                                .apexcharts-legend.position-right,
                                .apexcharts-legend.position-left {
                                    justify-content: flex-start;
                                }

                                .apexcharts-legend.position-bottom.apexcharts-align-center,
                                .apexcharts-legend.position-top.apexcharts-align-center {
                                    justify-content: center;
                                }

                                .apexcharts-legend.position-bottom.apexcharts-align-right,
                                .apexcharts-legend.position-top.apexcharts-align-right {
                                    justify-content: flex-end;
                                }

                                .apexcharts-legend-series {
                                    cursor: pointer;
                                    line-height: normal;
                                }

                                .apexcharts-legend.position-bottom .apexcharts-legend-series,
                                .apexcharts-legend.position-top .apexcharts-legend-series {
                                    display: flex;
                                    align-items: center;
                                }

                                .apexcharts-legend-text {
                                    position: relative;
                                    font-size: 14px;
                                }

                                .apexcharts-legend-text *,
                                .apexcharts-legend-marker * {
                                    pointer-events: none;
                                }

                                .apexcharts-legend-marker {
                                    position: relative;
                                    display: inline-block;
                                    cursor: pointer;
                                    margin-right: 3px;
                                    border-style: solid;
                                }

                                .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                    display: inline-block;
                                }

                                .apexcharts-legend-series.apexcharts-no-click {
                                    cursor: auto;
                                }

                                .apexcharts-legend .apexcharts-hidden-zero-series,
                                .apexcharts-legend .apexcharts-hidden-null-series {
                                    display: none !important;
                                }

                                .apexcharts-inactive-legend {
                                    opacity: 0.45;
                                }
                            </style>
                        </foreignObject>
                        <g id="SvgjsG1309" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 0)">
                            <defs id="SvgjsDefs1308">
                                <clipPath id="gridRectMaskfc3noor2">
                                    <rect id="SvgjsRect1311" width="184" height="69.66666666666669" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                                <clipPath id="forecastMaskfc3noor2"></clipPath>
                                <clipPath id="nonForecastMaskfc3noor2"></clipPath>
                                <clipPath id="gridRectMarkerMaskfc3noor2">
                                    <rect id="SvgjsRect1312" width="182" height="71.66666666666669" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                                <filter id="SvgjsFilter1321" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                                    <feFlood id="SvgjsFeFlood1322" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1322Out" in="SourceGraphic"></feFlood>
                                    <feComposite id="SvgjsFeComposite1323" in="SvgjsFeFlood1322Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1323Out"></feComposite>
                                    <feOffset id="SvgjsFeOffset1324" dx="1" dy="1" result="SvgjsFeOffset1324Out" in="SvgjsFeComposite1323Out"></feOffset>
                                    <feGaussianBlur id="SvgjsFeGaussianBlur1325" stdDeviation="1 " result="SvgjsFeGaussianBlur1325Out" in="SvgjsFeOffset1324Out"></feGaussianBlur>
                                    <feMerge id="SvgjsFeMerge1326" result="SvgjsFeMerge1326Out" in="SourceGraphic">
                                        <feMergeNode id="SvgjsFeMergeNode1327" in="SvgjsFeGaussianBlur1325Out"></feMergeNode>
                                        <feMergeNode id="SvgjsFeMergeNode1328" in="[object Arguments]"></feMergeNode>
                                    </feMerge>
                                    <feBlend id="SvgjsFeBlend1329" in="SourceGraphic" in2="SvgjsFeMerge1326Out" mode="normal" result="SvgjsFeBlend1329Out"></feBlend>
                                </filter>
                                <filter id="SvgjsFilter1334" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                                    <feFlood id="SvgjsFeFlood1335" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1335Out" in="SourceGraphic"></feFlood>
                                    <feComposite id="SvgjsFeComposite1336" in="SvgjsFeFlood1335Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1336Out"></feComposite>
                                    <feOffset id="SvgjsFeOffset1337" dx="1" dy="1" result="SvgjsFeOffset1337Out" in="SvgjsFeComposite1336Out"></feOffset>
                                    <feGaussianBlur id="SvgjsFeGaussianBlur1338" stdDeviation="1 " result="SvgjsFeGaussianBlur1338Out" in="SvgjsFeOffset1337Out"></feGaussianBlur>
                                    <feMerge id="SvgjsFeMerge1339" result="SvgjsFeMerge1339Out" in="SourceGraphic">
                                        <feMergeNode id="SvgjsFeMergeNode1340" in="SvgjsFeGaussianBlur1338Out"></feMergeNode>
                                        <feMergeNode id="SvgjsFeMergeNode1341" in="[object Arguments]"></feMergeNode>
                                    </feMerge>
                                    <feBlend id="SvgjsFeBlend1342" in="SourceGraphic" in2="SvgjsFeMerge1339Out" mode="normal" result="SvgjsFeBlend1342Out"></feBlend>
                                </filter>
                                <filter id="SvgjsFilter1347" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                                    <feFlood id="SvgjsFeFlood1348" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1348Out" in="SourceGraphic"></feFlood>
                                    <feComposite id="SvgjsFeComposite1349" in="SvgjsFeFlood1348Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1349Out"></feComposite>
                                    <feOffset id="SvgjsFeOffset1350" dx="1" dy="1" result="SvgjsFeOffset1350Out" in="SvgjsFeComposite1349Out"></feOffset>
                                    <feGaussianBlur id="SvgjsFeGaussianBlur1351" stdDeviation="1 " result="SvgjsFeGaussianBlur1351Out" in="SvgjsFeOffset1350Out"></feGaussianBlur>
                                    <feMerge id="SvgjsFeMerge1352" result="SvgjsFeMerge1352Out" in="SourceGraphic">
                                        <feMergeNode id="SvgjsFeMergeNode1353" in="SvgjsFeGaussianBlur1351Out"></feMergeNode>
                                        <feMergeNode id="SvgjsFeMergeNode1354" in="[object Arguments]"></feMergeNode>
                                    </feMerge>
                                    <feBlend id="SvgjsFeBlend1355" in="SourceGraphic" in2="SvgjsFeMerge1352Out" mode="normal" result="SvgjsFeBlend1355Out"></feBlend>
                                </filter>
                                <filter id="SvgjsFilter1360" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                                    <feFlood id="SvgjsFeFlood1361" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1361Out" in="SourceGraphic"></feFlood>
                                    <feComposite id="SvgjsFeComposite1362" in="SvgjsFeFlood1361Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1362Out"></feComposite>
                                    <feOffset id="SvgjsFeOffset1363" dx="1" dy="1" result="SvgjsFeOffset1363Out" in="SvgjsFeComposite1362Out"></feOffset>
                                    <feGaussianBlur id="SvgjsFeGaussianBlur1364" stdDeviation="1 " result="SvgjsFeGaussianBlur1364Out" in="SvgjsFeOffset1363Out"></feGaussianBlur>
                                    <feMerge id="SvgjsFeMerge1365" result="SvgjsFeMerge1365Out" in="SourceGraphic">
                                        <feMergeNode id="SvgjsFeMergeNode1366" in="SvgjsFeGaussianBlur1364Out"></feMergeNode>
                                        <feMergeNode id="SvgjsFeMergeNode1367" in="[object Arguments]"></feMergeNode>
                                    </feMerge>
                                    <feBlend id="SvgjsFeBlend1368" in="SourceGraphic" in2="SvgjsFeMerge1365Out" mode="normal" result="SvgjsFeBlend1368Out"></feBlend>
                                </filter>
                                <filter id="SvgjsFilter1373" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                                    <feFlood id="SvgjsFeFlood1374" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1374Out" in="SourceGraphic"></feFlood>
                                    <feComposite id="SvgjsFeComposite1375" in="SvgjsFeFlood1374Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1375Out"></feComposite>
                                    <feOffset id="SvgjsFeOffset1376" dx="1" dy="1" result="SvgjsFeOffset1376Out" in="SvgjsFeComposite1375Out"></feOffset>
                                    <feGaussianBlur id="SvgjsFeGaussianBlur1377" stdDeviation="1 " result="SvgjsFeGaussianBlur1377Out" in="SvgjsFeOffset1376Out"></feGaussianBlur>
                                    <feMerge id="SvgjsFeMerge1378" result="SvgjsFeMerge1378Out" in="SourceGraphic">
                                        <feMergeNode id="SvgjsFeMergeNode1379" in="SvgjsFeGaussianBlur1377Out"></feMergeNode>
                                        <feMergeNode id="SvgjsFeMergeNode1380" in="[object Arguments]"></feMergeNode>
                                    </feMerge>
                                    <feBlend id="SvgjsFeBlend1381" in="SourceGraphic" in2="SvgjsFeMerge1378Out" mode="normal" result="SvgjsFeBlend1381Out"></feBlend>
                                </filter>
                            </defs>
                            <g id="SvgjsG1313" class="apexcharts-pie">
                                <g id="SvgjsG1314" transform="translate(0, 0) scale(1)">
                                    <circle id="SvgjsCircle1315" r="17.55528455284554" cx="89" cy="33.83333333333334" fill="transparent"></circle>
                                    <g id="SvgjsG1316" class="apexcharts-slices">
                                        <g id="SvgjsG1317" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx1" rel="1" data:realIndex="0">
                                            <path id="SvgjsPath1318" d="M 89 6.825203252032516 A 27.008130081300827 27.008130081300827 0 0 1 115.9901115633003 34.819724882906854 L 106.54357251614519 34.47448784055613 A 17.55528455284554 17.55528455284554 0 0 0 89 16.278048780487804 L 89 6.825203252032516 z" fill="rgba(0,143,251,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="92.09302325581395" data:startAngle="0" data:strokeWidth="2" data:value="44" data:pathOrig="M 89 6.825203252032516 A 27.008130081300827 27.008130081300827 0 0 1 115.9901115633003 34.819724882906854 L 106.54357251614519 34.47448784055613 A 17.55528455284554 17.55528455284554 0 0 0 89 16.278048780487804 L 89 6.825203252032516 z" stroke="#ffffff"></path>
                                        </g>
                                        <g id="SvgjsG1330" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx2" rel="2" data:realIndex="1">
                                            <path id="SvgjsPath1331" d="M 115.9901115633003 34.819724882906854 A 27.008130081300827 27.008130081300827 0 0 1 76.65073985351212 57.85280177713602 L 80.97298090478287 49.44598782180508 A 17.55528455284554 17.55528455284554 0 0 0 106.54357251614519 34.47448784055613 L 115.9901115633003 34.819724882906854 z" fill="rgba(0,227,150,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="115.11627906976746" data:startAngle="92.09302325581395" data:strokeWidth="2" data:value="55" data:pathOrig="M 115.9901115633003 34.819724882906854 A 27.008130081300827 27.008130081300827 0 0 1 76.65073985351212 57.85280177713602 L 80.97298090478287 49.44598782180508 A 17.55528455284554 17.55528455284554 0 0 0 106.54357251614519 34.47448784055613 L 115.9901115633003 34.819724882906854 z" stroke="#ffffff"></path>
                                        </g>
                                        <g id="SvgjsG1343" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx3" rel="3" data:realIndex="2">
                                            <path id="SvgjsPath1344" d="M 76.65073985351212 57.85280177713602 A 27.008130081300827 27.008130081300827 0 0 1 64.14317055433537 23.270326166924406 L 72.84306086031799 26.967378675167534 A 17.55528455284554 17.55528455284554 0 0 0 80.97298090478287 49.44598782180508 L 76.65073985351212 57.85280177713602 z" fill="rgba(254,176,25,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="85.81395348837208" data:startAngle="207.2093023255814" data:strokeWidth="2" data:value="41" data:pathOrig="M 76.65073985351212 57.85280177713602 A 27.008130081300827 27.008130081300827 0 0 1 64.14317055433537 23.270326166924406 L 72.84306086031799 26.967378675167534 A 17.55528455284554 17.55528455284554 0 0 0 80.97298090478287 49.44598782180508 L 76.65073985351212 57.85280177713602 z" stroke="#ffffff"></path>
                                        </g>
                                        <g id="SvgjsG1356" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx4" rel="4" data:realIndex="3">
                                            <path id="SvgjsPath1357" d="M 64.14317055433537 23.270326166924406 A 27.008130081300827 27.008130081300827 0 0 1 74.93037551950482 10.779380148113297 L 79.85474408767813 18.848263762940313 A 17.55528455284554 17.55528455284554 0 0 0 72.84306086031799 26.967378675167534 L 64.14317055433537 23.270326166924406 z" fill="rgba(255,69,96,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="35.58139534883719" data:startAngle="293.0232558139535" data:strokeWidth="2" data:value="17" data:pathOrig="M 64.14317055433537 23.270326166924406 A 27.008130081300827 27.008130081300827 0 0 1 74.93037551950482 10.779380148113297 L 79.85474408767813 18.848263762940313 A 17.55528455284554 17.55528455284554 0 0 0 72.84306086031799 26.967378675167534 L 64.14317055433537 23.270326166924406 z" stroke="#ffffff"></path>
                                        </g>
                                        <g id="SvgjsG1369" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx5" rel="5" data:realIndex="4">
                                            <path id="SvgjsPath1370" d="M 74.93037551950482 10.779380148113297 A 27.008130081300827 27.008130081300827 0 0 1 88.99528619207668 6.825203663389857 L 88.99693602484983 16.278049047870077 A 17.55528455284554 17.55528455284554 0 0 0 79.85474408767813 18.848263762940313 L 74.93037551950482 10.779380148113297 z" fill="rgba(119,93,208,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-4" index="0" j="4" data:angle="31.395348837209326" data:startAngle="328.6046511627907" data:strokeWidth="2" data:value="15" data:pathOrig="M 74.93037551950482 10.779380148113297 A 27.008130081300827 27.008130081300827 0 0 1 88.99528619207668 6.825203663389857 L 88.99693602484983 16.278049047870077 A 17.55528455284554 17.55528455284554 0 0 0 79.85474408767813 18.848263762940313 L 74.93037551950482 10.779380148113297 z" stroke="#ffffff"></path>
                                        </g>
                                        <g id="SvgjsG1319" class="apexcharts-datalabels"><text id="SvgjsText1320" font-family="Helvetica, Arial, sans-serif" x="105.04067849881994" y="18.368175259094066" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1321)" style="font-family: Helvetica, Arial, sans-serif;">25.6%</text></g>
                                        <g id="SvgjsG1332" class="apexcharts-datalabels"><text id="SvgjsText1333" font-family="Helvetica, Arial, sans-serif" x="100.25813059520378" y="53.061671183107286" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1334)" style="font-family: Helvetica, Arial, sans-serif;">32.0%</text></g>
                                        <g id="SvgjsG1345" class="apexcharts-datalabels"><text id="SvgjsText1346" font-family="Helvetica, Arial, sans-serif" x="68.04662114682334" y="41.411617809318784" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1347)" style="font-family: Helvetica, Arial, sans-serif;">23.8%</text></g>
                                        <g id="SvgjsG1358" class="apexcharts-datalabels"><text id="SvgjsText1359" font-family="Helvetica, Arial, sans-serif" x="72.13640392527945" y="19.269899384144622" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1360)" style="font-family: Helvetica, Arial, sans-serif;">9.9%</text></g>
                                        <g id="SvgjsG1371" class="apexcharts-datalabels"><text id="SvgjsText1372" font-family="Helvetica, Arial, sans-serif" x="82.97143071991023" y="12.38267289131267" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1373)" style="font-family: Helvetica, Arial, sans-serif;">8.7%</text></g>
                                    </g>
                                </g>
                            </g>
                            <line id="SvgjsLine1382" x1="0" y1="0" x2="178" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                            <line id="SvgjsLine1383" x1="0" y1="0" x2="178" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                        </g>
                        <g id="SvgjsG1310" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-tooltip apexcharts-theme-dark" style="left: 75.1406px; top: -6px;">
                        <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex; background-color: rgb(0, 143, 251);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251); display: none;"></span>
                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">series-1: </span><span class="apexcharts-tooltip-text-y-value">44</span></div>
                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 2; display: none; background-color: rgb(0, 143, 251);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251); display: none;"></span>
                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">series-1: </span><span class="apexcharts-tooltip-text-y-value">44</span></div>
                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 3; display: none; background-color: rgb(0, 143, 251);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251); display: none;"></span>
                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">series-1: </span><span class="apexcharts-tooltip-text-y-value">44</span></div>
                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 4; display: none; background-color: rgb(0, 143, 251);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251); display: none;"></span>
                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">series-1: </span><span class="apexcharts-tooltip-text-y-value">44</span></div>
                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 5; display: none; background-color: rgb(0, 143, 251);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251); display: none;"></span>
                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">series-1: </span><span class="apexcharts-tooltip-text-y-value">44</span></div>
                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="resize-triggers">
                <div class="expand-trigger">
                    <div style="width: 425px; height: 461px;"></div>
                </div>
                <div class="contract-trigger"></div>
            </div>
            <svg id="SvgjsSvg1078" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
                <defs id="SvgjsDefs1079"></defs>
                <polyline id="SvgjsPolyline1080" points="0,0"></polyline>
                <path id="SvgjsPath1081" d="M0 0 "></path>
            </svg>
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