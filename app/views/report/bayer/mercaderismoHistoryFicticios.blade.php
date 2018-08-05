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
                            <div id="chartdiv1" style="width: 100%; height: 400px;" ></div>
                        </div>
                        <div class="report-marco " id="legend">

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
    });

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

    <script>
        function ajaxGrafico(url_base,url,params, functionCreateChart , divChart,divLoading,message,divLegend) {
            var url_base = url_base;
            var url = url ;
            var divChart = divChart ;
            var divLoading = divLoading;
            var divLegend = divLegend;
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";
            var htmlLegend = "";

            $("#"+divLoading).html(loading);
            $.post(url , params,  function(data) {
                //console.log (data.toString());
            })
                .done(function(data) {
                    console.log (data);
                    var textoOpciones = data.textoOpciones;
                    //creaGraficoColumnasPorBloques(chartData3,"chartdiv3",true,false,url_base,0,100,0,"regular");
                    //creaGraficoColumnasPorBloques(data,div, activelegend , rotation,url_base,escala_min, escala_max,label_rotation_grade,stackType,porcent,colors)
                    functionCreateChart(data.results, divChart,true,false,url_base,0,100,0,"regular","",data.colors);
                    htmlLegend = htmlLegend + "<div class'row pl'><div class='col-md-12'><h4>Detalles</h4></div>";
                    htmlLegend = htmlLegend + "<div class='row pl pb'>";
                    htmlLegend = htmlLegend + "<div class='col-md-12 legend'>";

                    if (textoOpciones.length>0) {
                        for (j = 0; j < textoOpciones.length; j++) {
                            var resultadosOpcion = textoOpciones[j].resultados;
                            htmlLegend = htmlLegend + "<div class='legend-block'>";
                            htmlLegend = htmlLegend + "<h6>" + textoOpciones[j].company + "</h6>";

                            if (resultadosOpcion.length>0) {
                                htmlLegend = htmlLegend + "<ul class='legend-elemet'>";
                                for (i = 0; i < resultadosOpcion.length; i++) {
                                    htmlLegend = htmlLegend + "<li data-toggle='tooltip' data-placement='top' title='"+resultadosOpcion[i].texto+"' data-original-title='"+resultadosOpcion[i].texto+"'>";
                                    htmlLegend = htmlLegend + "<span class='icon-legend' style='background-color:"+resultadosOpcion[i].color+"'>" + "</span>";
                                    htmlLegend = htmlLegend + resultadosOpcion[i].porcentaje + " % (" + resultadosOpcion[i].cantidad + ")";
                                    htmlLegend = htmlLegend + "</li>";
                                }
                                htmlLegend = htmlLegend + "</ul>";
                            }

                            htmlLegend = htmlLegend + "</div>";
                        }
                    }


                    htmlLegend = htmlLegend + "</div>";
                    htmlLegend = htmlLegend + "</div>";
                    htmlLegend = htmlLegend + "</div>";
                    $("#"+divLegend).html(htmlLegend);
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
            var cadena = 0;
            var client = 0;
            var campaignes = 0;//ajaxHistoryPrices

            var url = url_base + "/ajaxGetFicticioHistory" ;
            //var params = JSON.parse('{"company_id":"' + company_id + '","chanel":"' + chanel + '","client":"' + client + '","category_product_id":"' + category_product_id + '","product_id":"' + product_id + '"}');

            var params = JSON.parse('{"companies":"' + campaignes + '","chanel":"' + cadena +  '","client":"' + client  + '"}');

            ajaxGrafico(url_base,url,params,creaGraficoColumnasPorBloques,"chartdiv1","load","No hay datos","legend");
        });
    </script>
@endsection