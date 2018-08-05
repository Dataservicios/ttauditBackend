@extends('layouts/bayerMercaderismo')
@section('content')
    <section>
    @include('report/partials/menuBayerMercaderismo')
    <div class="cuerpo">
        <div class="cuerpo-content">
            <!--sección titulo y buscador-->
            <div class="row pt pb">
                <div class="col-sm-9">
                    <h4 class="report-title">{{$titulo}}</h4>
                </div>
                <div class="col-sm-3">
                    <img src="{{$logo}}" width="100px">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <!--Filtros con combos-->

                                <!-- Fin Filtros con combos-->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="rubro">&emsp;</label>
                                {{Form::select('campaigne', $campaignes, '0', ['id'=>'campaigne','class' => 'form-control', 'onchange' => 'newCampaigne(this)'])}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-6 pb">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>Locales Abiertos / Cerrados</h4>
                                    </div>
                                </div>
                                <div class="grafico-circle">
                                    <div id="chartdiv0" style="width: 100%; height: 350px;" ></div>
                                </div>
                                @if($linkCerrados<>0)
                                    <div>
                                        <a href="{{route('getDetailQuestionBayerMerc', $linkCerrados)}}" class="btn btn-primary btn-sm active" role="button">Ver Cerrados</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 pb">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>¿Permitió tomar Información?</h4>
                                    </div>
                                </div>
                                <div class="grafico-circle">
                                    <div id="chartdiv1" style="width: 100%; height: 350px;" ></div>
                                </div>
                                @if($linkNoPermitio<>0)
                                    <div>
                                        <a href="{{route('getDetailQuestionBayerMerc', $linkNoPermitio)}}" class="btn btn-primary btn-sm active" role="button">No Permitio</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="col-md-12 ">
                                <h4>Material POP Bayer Encontrado</h4>
                            </div>
                        </div>
                        <div class="grafico-circle">
                            <div id="chartdiv2" style="width: 100%; height: 450px;" ></div>

                        </div>

                        @if(count($detalleEncontradosPop)>0)
                            <div class="report-marco ">

                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>Detalle Pop Encontrado</h4>
                                    </div>
                                </div>

                                {{-- leyenda ---------------}}
                                <div class="row pl pb ">
                                    <div class="col-md-12 legend">
                                        @foreach($detalleEncontradosPop as $detalle)
                                            <div class="legend-block">
                                                <h6>{{$detalle['tipo']}}</h6>
                                                <ul class="legend-elemet">
                                                    @foreach($detalle['detalles'] as $detail)
                                                        <li data-toggle="tooltip" data-placement="top" title="{{$detail['texto']}}">
                                                            <span class="icon-legend" style="background-color:{{$detail['color']}}"></span> {{$detail['porcentaje'].'% ('.$detail['cantidad'].')'}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- ----------------FIN---------------}}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="col-md-12 ">
                                <h4>Cobertura Visiblidad Bayer vs Competencia</h4>
                            </div>
                        </div>
                        <div class="grafico-circle">
                            <div id="chartdiv3" style="width: 100%; height: 350px;" ></div>
                            <div style="text-align: left; font-weight: bold; padding-left: 5px;"><small>No Considera AASS</small></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

@stop

@section('report')
    <!-- Libreria AMCHART -->


        {{ HTML::script('lib/amcharts/amcharts.js') }}
        {{ HTML::script('lib/amcharts/serial.js') }}
        {{ HTML::script('lib/amcharts/pie.js') }}
    <!-- Export plugin includes and styles -->
    {{ HTML::script('lib/amcharts/plugins/export/export.js') }}
    {{ HTML::script('lib/amcharts/plugins/export/export.config.default.js') }}

        {{ HTML::script('js/graficos/Bayer-chart-ventas.js') }}
        {{ HTML::script('js/ajaxJsonFunction.js') }}

        <!-- // Libreria AMCHART creaGraficoColumnas(chartData2,"char3");	-->
<script>
    var url_base =  "{{ URL::to('/') }}" ;
    // Grafico Abierto Cerrado
    var chartData0 = JSON.parse('{{$valAbiertosJson}}');
    //createGraphPie(chartData0,"chartdiv0");
    createGraphPieV2(chartData0,"chartdiv0",false,true);
    // Grafico Permitio
    var chartData1 = JSON.parse('{{$valPermitioJson}}');
    //createGraphPie(chartData1,"chartdiv1");
    createGraphPieV2(chartData1,"chartdiv1",false,true);

    var chartData2 = JSON.parse('{{$valPopJson}}');
    var chartColors = JSON.parse('{{$valColorEncontradosPop}}');
    creaGraficoColumnasPorBloques(chartData2,"chartdiv2",true,false,url_base,0,100,45,"none","",chartColors);

    var chartData3 = JSON.parse('{{$valPopCompJson}}');
    creaGraficoColumnasMercaderismo(chartData3,"chartdiv3",false,null,0,100,null,0);
</script>
    <script>
        function newCampaigne(valor){

            if(valor.value != 0){
                var fullname = valor.options[valor.selectedIndex].text;
                var url= "{{ route('mercaResume') }}" + "/" + valor.value + "/" + fullname ;
                var win = window.open(url, '_blank');
                win.focus();
            }
        }
    </script>
@endsection