@extends('layouts.clienteBayer')
@section('content')
<section>
    {{--@include('report/partials/menuPrincipalColgate')--}}
    <div class="cuerpo">
        <div class="cuerpo-content">
            <!--sección titulo y buscador-->
            <div class="row pt pb">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-md-12 pb">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>Tiempo Real</h4>
                                    </div>
                                </div>
                                <div class="row pl pt">
                                    <div class="col-md-12 ">
                                        <div class="grafico-circle">
                                            <div id="load_xx"></div>
                                            <div id="chartdiv-real-time" style="width: 100%; height: 450px;" ></div>
                                            <div style="text-align: center"><small>El Gráfico muestra los 4 productos más recomendados en todos los estudios y los compara entre ellos.</small></div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pb">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>¿Se Recomendo El Producto?</h4>
                                    </div>
                                </div>
                                <div class="grafico-circle">
                                    <div id="chartdiv5381620" style="width: 100%; height: 250px; overflow: hidden; text-align: left;">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 pb">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>¿Tiene Stock?</h4>
                                    </div>
                                </div>
                                <div class="grafico-circle">
                                    <div id="chartdiv5381622" style="width: 100%; height: 250px; overflow: hidden; text-align: left;">

                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12 pb">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>Pruebaaaa</h4>
                                    </div>
                                </div>
                                <div class="row pl pt">
                                    <div class="col-md-12 ">
                                        <div class="grafico-circle">
                                            <div id="load_xx"></div>
                                            <div id="chartdiv_xx" style="width: 100%; height: 450px;" ></div>
                                            <div style="text-align: center"><small>El Gráfico muestra los 4 productos más recomendados en todos los estudios y los compara entre ellos.</small></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pl pt">
                                    <div class="col-md-12">
                                        <div class="grafico-circle">
                                            <div id="load2"></div>
                                            <div id="chartdiv2" style="width: 100%; height: 450px;" ></div>
                                            <div style="text-align: center"><small>El Gráfico muestra los 4 productos más recomendados en todos los estudios y los compara entre ellos.</small></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pl pt">
                                    <div class="col-md-12">
                                        <div class="grafico-circle">
                                            <div id="load2"></div>
                                            <div id="chartdiv1" style="width: 100%; height: 450px;" ></div>
                                            <div style="text-align: center"><small>El Gráfico muestra los 4 productos más recomendados en todos los estudios y los compara entre ellos.</small></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pl pt">
                                    <div class="col-md-12">
                                        <div class="grafico-circle">
                                            <div id="load2"></div>
                                            <div id="chartdiv12" style="width: 100%; height: 450px;" ></div>
                                            <div style="text-align: center"><small>El Gráfico muestra los 4 productos más recomendados en todos los estudios y los compara entre ellos.</small></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
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


        {{ HTML::script('lib/amcharts/amcharts.js'); }}
        {{ HTML::script('lib/amcharts/serial.js'); }}
        {{ HTML::script('lib/amcharts/pie.js'); }}
    <!-- Export plugin includes and styles -->
    {{ HTML::script('lib/amcharts/plugins/export/export.js'); }}
    {{ HTML::script('lib/amcharts/plugins/export/export.config.default.js'); }}

        {{ HTML::script('js/graficos/Bayer-chart-ventas.js'); }}
        {{ HTML::script('js/ajaxJsonFunction.js'); }}

        <!-- // Libreria AMCHART creaGraficoColumnas(chartData2,"char3");	-->
<script>
//Activa cuadro de comparación de campaªna
    $( "#change" ).on( "click", function( event ) {
        event.preventDefault();
        $('#alertaCompara').show();
        $('#change').hide();
//            $("#alertaFiltro").toggleClass("show");

    });

    $('.close').click(function() {
        $("#alertaCompara").hide();
        $('#change').show();
    });

</script>
<script>
    function newCampaigne(valor){

        {{--if(valor.value != 0){--}}
            {{--var fullname = valor.options[valor.selectedIndex].text;--}}
            {{--var url= "{{ $urlBase }}" + valor.value ;--}}
            {{--var win = window.open(url, '_blank');--}}
            {{--win.focus();--}}
        {{--}--}}
    }
</script>
<script>

    var url_base =  "{{ URL::to('/') }}" ;
    $(document).ready(function() {
        var params = [{
            color: "#08A5DE,#FF0000,#FFFF00,#008000",
            competencia0: 20,
            competencia1: 54,
            competencia2: 0,
            competencia3: 26,
            competencias: 4,
            estudio: "2Q JUL 16",
            names: "Apronax,Otros,Miodel,Doloflam Extra Fuerte"
        },
            {
                color: "#08A5DE,#FF0000,#FFFF00,#008000",
                competencia0: 20,
                competencia1: 54,
                competencia2: 4,
                competencia3: 26,
                competencias: 4,
                estudio: "2Q JUL 16",
                names: "Apronax,Otros,Miodel,Doloflam Extra Fuerte"
            },
            {
                color: "#08A5DE,#FF0000,#FFFF00,#008000",
                competencia0: 70,
                competencia1: 44,
                competencia2: 10,
                competencia3: 26,
                competencias: 47,
                estudio: "2Q JUL 16",
                names: "Apronax,Otros,Miodel,Doloflam Extra Fuerte"
            }];

        createChartLineal(params, chartdiv_xx, "http://ttaudit.com/")


        var chartData2 = [
            {
                "tipo": "Corporeos",
                "cantidades": "1000|1100|500|400",
                "Base": 100,
                "presencia": 110,
                "Buen Estado": 50,
                "Mal estado": 40
            },
            {
                "tipo": "Ficticios",
                "cantidades": "1000|200|600|200",
                "Base": 100,
                "presencia": 20,
                "Buen Estado": 60,
                "Mal estado": 20
            }
        ];

        creaGraficoColumnasPorBloques(chartData2, "chartdiv2", true, false, "http://ttaudit.com/", 0, 100, 0, "none");
        // creaGraficoColumnasPorBloques(chartData2,"chartdiv2",true,false,"http://ttaudit.com/",0,100,0,"regular");

        var chartData1 = JSON.parse('[{"respuesta":"Base","cantidad":125,"porcentaje":100},{"respuesta":"Corporeos","cantidad":105,"porcentaje":84}]');
        console.log(chartData1);
        creaGraficoColumnasMercaderismo(chartData1, "chartdiv1", false, null, 0, 100, null, 0);

        var chartData0 = JSON.parse('[{"tipo":"Si","cantidad":218,"color":"#1A8EC7"},{"tipo":"No","cantidad":128,"color":"#1AB1E6"}]');
        createGraphPieV2(chartData0, "chartdiv5381620", true, true);
        var chartData0 = JSON.parse('[{"tipo":"Si","cantidad":345,"color":"#1A8EC7"},{"tipo":"No","cantidad":1,"color":"#1AB1E6"}]');
        createGraphPieV2(chartData0, "chartdiv5381622", false, true);


        var params = [

                {
                    "estudio": "1Q MAR 17",
                    "competencia0": 36,
                    "competencia1": 30,
                    "competencia2": 23,
                    "competencia3": 31,
                    "competencia5": 5,
                    "competencia6": 8,
                    "competencia7": 9,
                    "competencia8": 7,
                    "competencia10": 11,
                    "competencia11": 12,
                    "competencia13": 3,
                    "competencia14": 8,
                    "competencias": 15,
                    "names": "Miopress Forte,Apronax,Dolgramin,Miodel,Redex,Dioxaflex,Flogodisten,Breflex,Naproxeno,Miofedrol,Dologyna,Iraxen ,Paldolor,Doloaproxol,Doloflam Extra Fuerte",
                    "color": "#F3500D,#687BCC,#0457F4,#08BF58,#50EB8E,#F833F7,#F33DA2,#03B179,#4979DD,#ACFF98,#5055DF,#1A6E4F,#C9050D,#EFD769,#76D45C,"
                },
                {
                    "estudio": "1Q ABR 17",
                    "competencia0": 4,

                    "competencia2": 2,
                    "competencia3": 18,
                    "competencia5": 11,
                    "competencia6": 24,
                    "competencia7": 3,
                    "competencia8": 25,
                    "competencia10": 5,
                    "competencia11": 7,
                    "competencia13": 1,
                    "competencia14": 18,
                    "competencias": 15,
                    "names": "Miopress Forte,Apronax,Dolgramin,Miodel,Redex,Dioxaflex,Flogodisten,Breflex,Naproxeno,Miofedrol,Dologyna,Iraxen ,Paldolor,Doloaproxol,Doloflam Extra Fuerte",
                    "color": "#4B22F6,#096091,#2F1DFC,#766CC1,#9AD7FA,#ED4FBE,#2FC606,#6712D9,#0B688A,#5F7DA6,#71D0D7,#013A51,#B5B388,#DB7B6D,#51E625,"
                },
                {
                    "estudio": "2Q ABR 17",
                    "competencia0": 10,
                    "competencia1": 26,
                    "competencia2": 14,
                    "competencia3": 13,
                    "competencia4": 3,
                    "competencia5": 11,
                    "competencia6": 9,
                    "competencia7": 5,
                    "competencia8": 23,
                    "competencia9": 2,
                    "competencia10": 10,
                    "competencia11": 1,
                    "competencia13": 2,

                    "competencias": 15,
                    "names": "Miopress Forte,Apronax,Dolgramin,Miodel,Redex,Dioxaflex,Flogodisten,Breflex,Naproxeno,Miofedrol,Dologyna,Iraxen ,Paldolor,Doloaproxol,Doloflam Extra Fuerte",
                    "color": "#B3C791,#71B221,#77FE6C,#DF31F2,#76AEEC,#C25450,#3BD40B,#436657,#787451,#5DD4F5,#5119F2,#F529C9,#B6A128,#05299B,#D53E80,"
                },
                {
                    "estudio": "1Q AGO 17",
                    "competencia0": 17,
                    "competencia1": 14,
                    "competencia2": 12,
                    "competencia3": 9,
                    "competencia4": 7,
                    "competencia5": 7,
                    "competencia6": 4,
                    "competencia7": 4,
                    "competencia8": 4,
                    "competencia9": 3,
                    "competencia10": 2,
                    "competencia11": 2,
                    "competencia12": 1,
                    "competencia13": 1,
                    "competencia14": 1,
                    "competencias": 15,
                    "names": "Miopress Forte,Apronax,Dolgramin,Miodel,Redex,Dioxaflex,Flogodisten,Breflex,Naproxeno,Miofedrol,Dologyna,Iraxen ,Paldolor,Doloaproxol,Doloflam Extra Fuerte",
                    "color": "#D3C5FE,#FC74ED,#EF4776,#6C5095,#E00864,#EC0CBF,#A21512,#9411C0,#813B9B,#EDADA3,#1B292C,#3E5CF8,#721D41,#A872BC,#8FBAFB,"
                }
            ]
    ;

        createChartLineal(params,chartdiv12,"http://ttaudit.com/")



//        ---------------------------REAL TIME GRAPH------------------------------


        /*
         * This demo illustrates real-time data updates from a websocket by
         * writing and listening to data events from a websocket echo server.
         */

        var interval;
        var websocket;

        var websocketEchoServerUri = "wss://echo.websocket.org/";
        var chartData = []; //will be updated by our simulated server
       // var serverLog = document.getElementById("server-log");
     //   var startButton = document.getElementById('start-demo');
     //   var endButton = document.getElementById('end-demo');
        var chart = AmCharts.makeChart("chartdiv-real-time", {
            "type": "serial",
            "theme": "light",
            "dataDateFormat": "YYYY-MM-DD",
            "valueAxes": [{
                "id": "v1",
                "position": "left"
            }],
            "graphs": [{
                "id": "g1",
                
                "valueField": "value",
                "balloonText": "[[category]]: [[value]]"
            }],
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "equalSpacing": true,
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "dataProvider": chartData
        });

        startDemo();
       // startButton.addEventListener('click', startDemo);
       // endButton.addEventListener('click', endDemo);

        function startDemo() {
            //startButton.disabled = "disabled";
            //endButton.disabled = "";
            websocket = initWebSocket(websocketEchoServerUri);
        }

        function endDemo() {
            startButton.disabled = "";
            endButton.disabled = "disabled";
            websocket.close();
        }

        function initWebSocket(wsUri) {
            var ws = new WebSocket(wsUri);
            ws.onopen = onConnect;
            ws.onclose = onClose;
            ws.onerror = onError;
            ws.onmessage = updateChart;
            return ws;
        }

        /*
         * Called during the onmessage event. Your application will need
         * to parse  your websocket server's response into a data object
         * or array of dataObjects your chart expects
         */
        function updateChart(wsEvent) {
            var newData = JSON.parse(wsEvent.data);
            chartData.push.apply(chartData, newData);
            // keep only 50 datapoints on screen for the demo
            if (chartData.length > 50) {
                chartData.splice(0, chartData.length - 50);
            }
            writeToScreen("<span style='color: blue'>Received: " + wsEvent.data + "</span>");
            chart.validateData(); //call to redraw the chart with new data
        }

        function onConnect(wsEvent) {
            writeToScreen("Server connection successful. Listening for data now.");
            interval = setInterval(getDataFromServer, 2000); //we're simulating a datafeed by calling our getDataFromServer method every 2 seconds
        }

        function onError(wsEvent) {
            writeToScreen("<span style='color: red'>ERROR:" + wsEvent + "</span>");
        }

        function onClose(wsEvent) {
            writeToScreen("Server connection closed");
            clearInterval(interval);
        }

//For debug messaging
        function writeToScreen(message) {
            var pre = document.createElement("p");
            pre.style.wordWrap = "break-word";
            pre.innerHTML = message;
            //serverLog.appendChild(pre);
            //serverLog.scrollTop = serverLog.scrollHeight;
        }

        /*
         * This simulates a data response from the server
         * using websocket.org's echo server. The method generates
         * a random sized array of values and writes it to
         * the server in the form of a JSON string,
         * which will be echoed back to the client
         */
        function getDataFromServer() {
            var newDate;
            var newValue;
            var newData = [];
            var newDataSize = Math.round(Math.random() + 3) + 1;

            if (chartData.length) {
                newDate = new Date(chartData[chartData.length - 1].date);
            } else {
                newDate = new Date();
            }

            for (var i = 0; i < newDataSize; ++i) {
                newValue = Math.round(Math.random() * (40 + i)) + 10 + i;
                newDate.setDate(newDate.getDate() + 1);

                newData.push({
                    date: newDate,
                    value: newValue
                });
            }

            websocket.send(JSON.stringify(newData));
        }
    });



</script>

@endsection