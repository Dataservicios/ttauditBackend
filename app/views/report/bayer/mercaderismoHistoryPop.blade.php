@extends('layouts/bayerMercaderismo')
@section('content')
    <section>
        @include('report/partials/menuBayerMercaderismo')
        <style>
            .filter .btn{
                font-size: 9px
            }

            .filter  h5{
                font-size: 12px;
                font-weight:bold ;
                margin-top: 0px ;
                margin-bottom: 5px;
                text-align: left;
            }
            .filter #marcas {
                text-align: center;
            }
            .filter #marcas a{
                font-size: 12px;
                font-weight:bold ;
                margin-top: 0px ;
                margin-bottom: 5px;
                text-align: center;
                text-decoration: none;
            }
            .filter span{
                font-size: 10px
            }
            .filter .btn-primary {
                color: #000000;
                background-color: #ffffff;
                margin: 2px;
                border-color: #bdbdbd;
            }

            .filter .btn-success {
                color: #ffffff;
                background-color: #787878;
                margin: 2px;
                border-color: #8a8a8a;
            }
            .filter .btn-success:hover  {
                color: #6FBAD1;
                background-color: #f3f3f3;
                margin: 2px;
                border-color: #bdbdbd;
            }
            .filter .panel-default {
                border: 0;

            }

            .filter .panel {
                -webkit-box-shadow: none;
                box-shadow: none ;
            }

            .filter #loading-filter {
                display: none;

            }

            .filter  {
                display: none;
            }


            #clear-selection {
                text-decoration: none;
            }

        </style>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="popCombo">TIPO POP</label>
                                    {{Form::select('popCombo', $pops, '0', ['id'=>'popCombo','class' => 'form-control'])}}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="rubro">&emsp;</label>
                                    <button class="btn btn-default" type="submit" id="filter">Filtrar</button>
                                </div>
                            </div>
                            <!-- Fin Filtros con combos-->
                            <div class="col-sm-4">

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pt pb">
                    <div class="col-sm-12">
                        <div class="report-marco ">
                            <div class="row pl">
                                <div class="col-md-12 ">
                                    <h4 id="subtitulo"></h4>
                                </div>
                            </div>
                            <div class="grafico-circle">
                                <div id="load"></div>
                                <div id="chartdiv1" style="width: 100%; height: 450px;" ></div>
                            </div>
                            <div class="report-marco " id="detalleGraph">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>Detalle Histórico Pop Encontrado</h4>
                                    </div>
                                </div>
                                {{-- leyenda ---------------}}
                                <div class="row pl pb " id="datosDetalle">

                                </div>
                                {{-- ----------------FIN---------------}}
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
        $(document).ready(function(){
            $('#filter').hide('slow');
            $('#detalleGraph').hide('slow');
        });

    </script>
    <script>

        $('#filter').on('click',function (event) {
            $('#filter').hide('slow');
            $("#datosDetalle").empty();

            var type = document.getElementById("popCombo");
            var pop = type.options[type.selectedIndex].value;

            var company_id = 0;
            var chanel = 0;

            var client = 0;
            var message="";

            $('#chartdiv1').empty();
            $('#subtitulo').empty();

            var url_base = "{{ URL::to('/') }}" ;
            var url = url_base + "/ajaxHistoryPop" ;
            var divChart = 'chartdiv1' ;
            var divLoading = 'load';
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";


            var params = JSON.parse('{"companies":"' + company_id + '","chanel":"' + chanel + '","client":"' + client + '","pop":"' + pop + '"}');

            $("#"+divLoading).html(loading);
            ajaxGrafico(url_base,url,params,creaGraficoColumnasPorBloques,divChart,divLoading,"No hay datos");

        })


    </script>
    <script>
        function ajaxGrafico(url_base,url,params, functionCreateChart , divChart,divLoading,message) {
            var url_base = url_base;
            var url = url ;
            var divChart = divChart ;
            var divLoading = divLoading
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";
            var contenidoDiv1 ='';

            $("#"+divLoading).html(loading);
            $.post(url , params,  function(data) {
                console.log (data.toString());
            })
                .done(function(data) {
                    functionCreateChart(data.results, divChart,true,false,url_base,0,100,0,"none","",data.colors);
                    var contenidoDiv="";
                    var contenidoDiv2="";
                    contenidoDiv2 = contenidoDiv2 + "<div class=\"col-md-12 legend\">\n";
                    for(i=0; i<data.detalle.length; i++) {
                        var detalles = data.detalle[i].detalles;
                        var campaigne = data.detalle[i].tipo;

                        if (detalles.length>0) {
                            contenidoDiv1 = contenidoDiv1 + "<div class=\"legend-block\">\n";
                            contenidoDiv1 = contenidoDiv1 + "<h6>" + campaigne + "</h6>";
                            contenidoDiv = contenidoDiv + "<ul class=\"legend-elemet\">";
                            for (j = 0; j < detalles.length; j++) {
                                console.log(campaigne,detalles[j]);
                                contenidoDiv = contenidoDiv + "<li data-toggle=\"tooltip\" data-placement=\"top\" title="+ detalles[j].texto +">";
                                contenidoDiv = contenidoDiv + "<span class=\"icon-legend\" style=\"background-color:" + detalles[j].color  + "\"></span>" + detalles[j].porcentaje + " %(" + detalles[j].cantidad + ")";
                                contenidoDiv = contenidoDiv + "</li>";
                            }
                            contenidoDiv = contenidoDiv + "</ul>";
                            contenidoDiv1 = contenidoDiv1 + contenidoDiv;contenidoDiv="";
                            contenidoDiv1 = contenidoDiv1 + "</div>";
                        }
                    }
                    contenidoDiv2 = contenidoDiv2 + contenidoDiv1;contenidoDiv1="";
                    contenidoDiv2 = contenidoDiv2 + "</div>";
                    $("#datosDetalle").html(contenidoDiv2);
                    $('#detalleGraph').show('slow');
                })
                .fail(function() {
                    $("#"+divLoading).html("<div class='" + divLoading +"'>" + message + "</div>");
                })
                .always(function() {
                    $("."+divLoading + " > img ").hide();
                });

        }
    </script>

    <script>
        var url_base =  "{{ URL::to('/') }}" ;
        $(document).ready(function(){

        });
    </script>
    <script>
        $("#popCombo").change(function(event){
            var popComboValue = event.target.value;
            if (popComboValue==0){
                $('#filter').hide('slow');
            }else{
                $('#filter').show('slow');
            }

        });
    </script>
@endsection