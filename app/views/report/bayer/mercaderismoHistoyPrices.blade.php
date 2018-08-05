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
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="product">CANAL</label>
                                {{Form::select('type', $types, '0', ['id'=>'type','class' => 'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="cliente">CLIENTE</label>
                                <div id="loadingCliente"></div>
                                <div id="comboCliente">{{Form::select('cliente', ['Selecciona'],'0', ['id'=>'cliente','class' => 'form-control'])}}</div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="categoria">CATEGORIA</label>
                                <div id="loadingCategoria"></div>
                                <div id="comboCategoria">{{Form::select('categoria', ['Selecciona'],'0', ['id'=>'categoria','class' => 'form-control'])}}</div>
                                {{Form::hidden('company_id', $company_id, ['id'=>'company_id'])}}
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="rubro">&emsp;</label>
                                <button class="btn btn-default" type="submit" id="filter">Filtrar</button>
                            </div>
                        </div>
                                <!-- Fin Filtros con combos-->
                        <div class="col-sm-2">

                        </div>
                    </div>
                </div>
            </div>
{{--  SECCION PRODUCTOS---------------}}
            <div class="row">
                        <!--Filtros con combos-->
                        <div class="col-sm-12 pt pb filter">
                                <div class="row">
                                    <div class="col-md-12  pb">
                                        <a id="clear-selection" href=""><span class="label label-info">Limpiar selección</span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  pb">
                                        <div class="panel-body ">
                                            {{--<h5 id="producto-title" data-toggle="collapse"  href="#panel-products">Productos <span class="caret"></span></h5>--}}
                                            <div id="marcas">
                                               <h5>Productos</h5>
                                            </div>
                                            <div id="panel-products"  class="">
                                                <div id="loading-filter"><img src="http://ttaudit.com/img/loading.gif" alt=""></div>
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
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
                                <h4 id="subtitulo"></h4>
                            </div>
                        </div>
                        <div class="grafico-circle">
                            <div id="load"></div>
                            <div id="chartdiv1" style="width: 100%; height: 650px;" ></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="col-md-12 ">
                                <h4 id="subtituloModa"></h4>
                            </div>
                        </div>
                        <div class="grafico-circle">
                            <div id="loadModa"></div>
                            <div id="chartdiv2" style="width: 100%; height: 650px;" ></div>
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
        var url_base =  "{{ URL::to('/') }}" ;
        $("#type").change(function(event){
            var type = event.target.value;
            var company_id = $('#company_id').val();
            var divLoading = 'loadingCliente';
            var divLoadingCategoria = 'loadingCategoria';
            var url = url_base + "/getCategoryProductForType" ;
            var urlCliente = url_base + "/getClientsMercaForChanel" ;
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading5.gif" + "' width='40px' ></div>";
            var loadingCategoria= "<div class='" + divLoadingCategoria +"'><img src='" + url_base +  "/img/loading5.gif" + "' width='40px' ></div>";

            var params = JSON.parse('{"type":"' + type + '","company_id":"' + company_id +'"}');
            $("#"+divLoading).html(loading);
            $("#"+divLoadingCategoria).html(loadingCategoria);
            $('#comboCategoria').hide('slow');
            $('#comboCliente').hide('slow');

            $('#panel-products').empty();
            
            $.post(urlCliente , params,  function(data) {
                //console.log (data.toString());
            })
                .done(function(data) {
                    $('#cliente').empty();
                    $("#cliente").append("<option value='0'> Selecciona</option>");
                    for(i=0; i<data.length; i++){console.log (data[i]);
                        $("#cliente").append("<option value='" +data[i].client+"'> "+data[i].client+"</option>")
                    }
                    $('#comboCliente').show('fast');

                    $.post(url , params,  function(data1) {
                        //console.log (data1.toString());
                    })
                        .done(function(data1) {
                            $('#categoria').empty();
                            $("#categoria").append("<option value='0'> Selecciona</option>");
                            for(i=0; i<data1.length; i++){
                                $("#categoria").append("<option value='" +data1[i].category_product_id+"'> "+data1[i].categoria+"</option>")
                            }

//                            $.each(data1, function(i, item){
//                                // console.log(item.fullname)
//                                strButton ='<button type="button" active="0"  id="'+ item.product_id + '" class="product btn btn-primary btn-xs">' + item.fullname + '</button>';
//                                $('#panel-products').append(strButton);
//                            });


                            $('#comboCategoria').show('fast');

                        })
                        .fail(function() {
                            $("#"+divLoadingCategoria).html("<div class='" + divLoadingCategoria +"'>message</div>");

                        })
                        .always(function() {
                            $("."+divLoadingCategoria + " > img ").hide();
                        });
                })
                .fail(function() {
                    $("#"+divLoading).html("<div class='" + divLoading +"'>message</div>");

                })
                .always(function() {
                    $("."+divLoading + " > img ").hide();
                });
        });
        $("#categoria").change(function(event){
            var categoria = event.target.value;
            var company_id = $('#company_id').val();
            var divLoading = 'loadingClienteP';
            var url = url_base + "/getProductsForCategoryMerca" ;
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading5.gif" + "' width='40px' ></div>";

            var params = JSON.parse('{"category":"' + categoria + '","company_id":"' + company_id +'"}');
            $("#"+divLoading).html(loading);
            $('#comboProducto').hide('slow');

            $('#panel-products').empty();
            $(".filter").css("display","block");

            $("#loading-filter").css("display","block");

            $.post(url , params,  function(data) {
                console.log (data.toString());
            })
                .done(function(data) {
                    console.log (data);
                    $('#producto').empty();
                    $("#producto").append("<option value='0'> Selecciona</option>");
                    for(i=0; i<data.length; i++){console.log (data[i]);
                        $("#producto").append("<option value='" +data[i].product_id+"'> "+data[i].fullname+"</option>")
                    }
                    $('#comboProducto').show('fast');

                    $.each(data, function(i, item){
                                // console.log(item.fullname)
                                strButton ='<button type="button" active="0"  id="'+ item.product_id + '" class="product btn btn-primary btn-xs">' + item.fullname + '</button>';
                                $('#panel-products').append(strButton);
                    });
                    $('#filter').show('fast');
                })
                .fail(function() {
                    $("#"+divLoading).html("<div class='" + divLoading +"'>message</div>");

                })
                .always(function() {
                    $("."+divLoading + " > img ").hide();
                    $("#loading-filter").css("display","none");
                });
        });

    </script>
    <script>



        $('#filter').on('click',function (event) {
            $('#filter').hide('slow');

            var type = document.getElementById("type");
            var chanel = type.options[type.selectedIndex].value;

            var cliente = document.getElementById("cliente");
            var client = cliente.options[cliente.selectedIndex].value;

            var categoria = document.getElementById("categoria");
            var category_product_id = categoria.options[categoria.selectedIndex].value;


            var company_id = 0;
            var product_id;
            var message="";

            $('#chartdiv1').empty();
            $('#subtitulo').empty();

            var url_base = "{{ URL::to('/') }}" ;
            var url = url_base + "/ajaxHistoryPrices" ;
            var divChart = 'chartdiv1' ;
            var divChartModa = 'chartdiv2' ;
            var divLoading = 'load';
            var divLoadingModa = 'loadModa';
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";

            $('#panel-products button').each(function(index, element ) {
                // console.log($(this).attr("active"))
                if($(this).attr("active") == 1) {
                    // company_id.push($(this).attr("id"));
                    if(company_id.length == 0) {
                        company_id  =  $(this).attr("id");;
                    } else {
                        if (product_id == undefined){
                            product_id =  $(this).attr("id") + "|";
                        }else{
                            product_id =  $(this).attr("id") + "|" + product_id;
                        }
                    }

                }
            });
            if (product_id == undefined){
                product_id="0";
            }

            var params = JSON.parse('{"companies":"' + company_id + '","chanel":"' + chanel + '","client":"' + client + '","category_product_id":"' + category_product_id + '","product_id":"' + product_id + '"}');

            $("#"+divLoading).html(loading);
            ajaxGrafico(url_base,url,params,createChartLinealHistory,divChart,divLoading,"No hay datos");

        })



        /// -------------------------ACTIVE/ DESACTVE PRODUCTS--------------------------

        $('#panel-products').on('click','button',function (e) {
            // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
            var idChanelActive = $(this).attr("id");
            if ($(this).attr("active") == 0) {
                $(this).removeClass('btn-primary').addClass('btn-success');
                $(this).attr("active", '1');
            } else if ($(this).attr("active") == 1) {
                $(this).removeClass('btn-success').addClass('btn-primary');
                $(this).attr("active", '0');
            }

        });

        //---------------------------------------------------Clear selection-------------------------------------

        $('#clear-selection').on("click",function (e) {
            e.preventDefault();


            $('#panel-products button').each(function(index, element ) {
                // console.log($(this).attr("active"))
                $(this).attr("active",'0');
                $(this).removeClass('btn-success').addClass('btn-primary');
            });
        })

        /// -------------------------  END ACTIVE/ DESACTVE PRODUCTS--------------------------
    </script>
    <script>
        function ajaxGrafico(url_base,url,params, functionCreateChart , divChart,divLoading,message) {
            var url_base = url_base;
            var url = url ;
            var divChart = divChart ;
            var divLoading = divLoading
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";

            $("#"+divLoading).html(loading);
            $.post(url , params,  function(data) {
                console.log (data.toString());
            })
                .done(function(data) {
                    functionCreateChart(data.results, divChart,url_base,'monedaS');

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
            /*var category_product_id = 67;
            var cadena = 0;
            var client = 0;
            var product_id = 0
            var ubigeoext = 0;
            var campaignes = 0;//ajaxHistoryPrices

            var url = url_base + "/ajaxHistoryPrices" ;
            //var params = JSON.parse('{"company_id":"' + company_id + '","chanel":"' + chanel + '","client":"' + client + '","category_product_id":"' + category_product_id + '","product_id":"' + product_id + '"}');

            var params = JSON.parse('{"companies":"' + campaignes + '","chanel":"' + cadena + '","category_product_id":"' + category_product_id + '","product_id":"' + product_id + '","client":"' + client  + '"}');
            ajaxGrafico(url_base,url,params,createChartLinealHistory,"chartdiv1","load","No hay datos");*/
        });
    </script>
@endsection