@extends('layouts/clienteBayer')
@section('content')
    <style>

        .filter .btn{
            font-size: 9px
        }

        .filter  h5{
            font-size: 12px;
            font-weight:bold ;
            margin-top: 0px ;
            margin-bottom: 5px;
            text-align: center;
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
            color: #ffffff;
            background-color: #a5a5a5;
            margin: 2px;
            border-color: #8a8a8a;
        }
        .filter .panel-default {
            border: 0;

        }

        .filter .panel {
            -webkit-box-shadow: none;
            box-shadow: none ;
        }

        #clear-selection {
            text-decoration: none;
        }

    </style>
<section>
    @include('report/partials/menuPrincipalBayer')
    <div class="cuerpo">
        <div class="cuerpo-content">
            <!--sección titulo y buscador-->
            <div class="row pt pb">
                <div class="col-sm-9">
                    <h4 class="report-title">{{$titulo}}</h4>
                    {{Form::hidden('company_id', $company_id, ['id'=>'company_id','class' => 'form-control'])}}
                    <div class="row pl pb ">
                        <div class="col-md-11 filter">
                            <div class="row">
                                <div class="col-md-12  pb">
                                    <a id="clear-selection" href=""><span class="label label-info">Borrar Filtros</span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            {{--<h5>Marcas</h5>--}}
                                            <div id="marcas">
                                                <a id="producto-title" data-toggle="collapse"  href="#panel-products">Marcas <span class="caret"></span></a>
                                            </div>
                                            <div id="panel-products"  class="panel-collapse collapse out">
                                                <div id="loading-filter"><img src="http://ttaudit.com/img/loading.gif" alt=""></div>
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>Períodos <a id="campaign-selection" active="1" href="#"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a></h5>
                                            <div id="panel-campaign">
                                                {{--<div id="loading-filter"><img src="http://ttaudit.com/img/loading.gif" alt=""></div>--}}
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>Ciudad <a id="city-selection" active="1" href="#"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a></h5>
                                            <div id="panel-city" show-element="0">
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>Canal</h5>
                                            <div id="panel-chanel" show-element="0">
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>Cliente</h5>
                                            <div id="panel-client" show-element="0">
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>Ejecutivo</h5>
                                            <div id="panel-ejecutivo" show-element="0">
                                                {{--<button type="button" class="campaign btn btn-success btn-xs">Holaa</button>--}}
                                                {{--<button type="button" class="campaign btn btn-primary btn-xs">Holaa</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-1">
                            <button type="button" id="filter" class="btn btn-primary btn-xs" disabled="true" >Filtrar</button>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">
                    <img src="{{$logo}}" width="100px" style="padding-left: 15px;">
                </div>
            </div>
            @foreach($ListProducts as $producto)
                {{Form::hidden('producto'.$producto->id, $producto->id, ['id'=>'producto'.$producto->id,'class' => 'form-control'])}}
                {{Form::hidden('cadena'.$producto->id, $canalLink, ['id'=>'cadena'.$producto->id])}}
                {{Form::hidden('horizontal'.$producto->id, $clienteLink, ['id'=>'horizontal'.$producto->id])}}
                {{Form::hidden('ejecutivo'.$producto->id, $ejecutivoLink, ['id'=>'ejecutivo'.$producto->id])}}
                {{Form::hidden('ubigeoext'.$producto->id, $ciudadLink, ['id'=>'ubigeoext'.$producto->id])}}
                {{Form::hidden('campaignes'.$producto->id, $valCampaignes, ['id'=>'campaignes'.$producto->id])}}
                <div id="{{'bloque'.$producto->id}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <img src="{{$urlProducts.$producto->product->imagen}}" width="300px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt pb">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12 pb">
                                    <div class="report-marco ">

                                        <div class="row pl">
                                            <div class="col-md-12 ">
                                                <h4>{{$subtitulo}}</h4>
                                            </div>
                                        </div>
                                        <div class="grafico-circle">
                                            <div id="{{'load'.$producto->id}}"></div>
                                            <div id="{{'chartdiv'.$producto->id}}" style="width: 100%; height: 650px;" ></div>
                                            <div id="{{'MessegesTop'.$producto->id}}" class="alert alert-info alert-dismissible" role="alert" style="text-align: center; font-size:11px;">
                                            </div>
                                            <div id="{{'MessegesTop'.$producto->id."-abiertos"}}" class="alert alert-info alert-dismissible" role="alert" style="text-align: center; font-size:11px;">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><div style="text-align: center; font-weight: bold"><small>Resultados ordenados según último estudio.</small></div></div>
                                                <div class="col-md-6"><div style="text-align: center; font-weight: bold"><small>Datos Históricos en base a recomendaciones.</small></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
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

    <script type="text/javascript">

        var url_base ="{{ asset('/') }}";
        var url = url_base + "getCampaignesBayer" ;
        var urlCity = url_base + "getCitiesForCampaigneAll" ;
        var urlClient = url_base + "getClientForCityForType" ;
        var urlEjecutiveByCity = url_base + "getEjecutiveForCity" ;
        var urlEjecutiveByCityChanel = url_base + "getEjecutivesForUbigeoChanel" ;
        var urlEjecutiveByCityClient = url_base + "getEjecutiveForCityForType" ;
        var urlEjecutive = url_base + "getEjecutivesForCampaigneAll" ;
        var urlProducts = url_base + "getProducts" ;
        var urlProductsByCampaigne = url_base + "getCompanyForProduct" ;
        var campaign    = "";
        var city    = "";
        var client      ="";
        var ejecutivoByCity = "";
        var ejecutivoByCityChanel ="";
        var products = "";
        var productsByCampaign = "";
        var ejecutivoByCityClient = "";


        $(document).ready(function($) {

            $.post(url ,  function(data) {

            })
                .done(function(data) {
                    campaign =  JSON.stringify(data);
                    //console.log(campaign);
                    $.post(urlClient ,  function(data2) {

                    })
                        .done(function(data2) {
                            client =  JSON.stringify(data2);
                            $.post(urlEjecutiveByCity ,  function(data3) {

                            })
                                .done(function(data3) {
                                    ejecutivoByCity =  JSON.stringify(data3);
                                    $.post(urlEjecutiveByCityChanel ,  function(data4) {

                                    })
                                        .done(function(data4) {
                                            ejecutivoByCityChanel =  JSON.stringify(data4);
                                            $.post(urlProducts ,  function(data5) {

                                            })
                                                .done(function(data5) {
                                                    products =  JSON.stringify(data5);

                                                    $.post(urlProductsByCampaigne ,  function(data6) {

                                                    })
                                                        .done(function(data6) {
                                                            productsByCampaign =  JSON.stringify(data6);
                                                            $.post(urlEjecutiveByCityClient ,  function(data7) {

                                                            })
                                                                .done(function(data7) {
                                                                    ejecutivoByCityClient =  JSON.stringify(data7);
                                                                    generateButtonProducts(JSON.parse(products))
                                                                    $("#loading-filter").remove();
                                                                })
                                                                .fail(function() {

                                                                })
                                                                .always(function() {
                                                                });
                                                        })
                                                        .fail(function() {

                                                        })
                                                        .always(function() {
                                                        });
                                                })
                                                .fail(function() {

                                                })
                                                .always(function() {
                                                });
                                        })
                                        .fail(function() {

                                        })
                                        .always(function() {
                                        });
                                })
                                .fail(function() {

                                })
                                .always(function() {
                                });
                        })
                        .fail(function() {

                        })
                        .always(function() {
                        });
                })
                .fail(function() {
                    //$("#"+divLoading).html("<div class='" + divLoading +"'>" + message + "</div>");

                })
                .always(function() {
                    //$("."+divLoading + " > img ").hide();
                });
            var counter_active = 0;
//-------------------Generando botones products--------------------------------

            function generateButtonProducts(data) {
                $.each(data.productos, function(i, item){
                    // console.log(item.fullname)
                    strButton ='<button type="button" active="0"  id="'+ item.product_id + '" class="product btn btn-primary btn-xs">' + item.fullname + '</button>';
                    $('#panel-products').append(strButton);
                });
            }

            $('#panel-products').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
                $('#campaign-selection').attr("active","1");
                $('#city-selection').attr("active","1");
                var idChanelActive = $(this).attr("id");
                if($(this).attr("active") == 0){
                    $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');
                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');
                }


                $('#panel-products button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("id") == idChanelActive) {
                        $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).attr("active",'1');

                    } else {

                        $(this).addClass('btn-primary').removeClass('btn-success');
                        $(this).attr("active",'0');
                    }

                });


                $('#panel-products button').each(function(index, element ) {

                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        counter_active ++;
                    }
                });
                if(counter_active > 0) {
                    $('#panel-campaign').empty();
                    $('#panel-city').empty();
                    $('#panel-chanel').empty();
                    //if($('#panel-city').attr("show-element") == 0) {
                    //generateButtonCity(JSON.parse(city));
//                    generateButtonCity(JSON.parse(campaign));
//                    generateButtonChanel(JSON.parse(campaign));
                    //generateButtonCampaign(JSON.parse(productsByCampaign))
                    generateButtonCampaignByProducto(JSON.parse(productsByCampaign));

                    //----------------------------  Activando y seleccionando todo los botones de campaña -----------------------------------------------
                    $('#panel-campaign button').each(function(index, element ) {
                        $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).attr("active",'1');
                    });

                    $('#panel-campaign button').each(function(index, element ) {
                        // console.log($(this).attr("active"))
                        if($(this).attr("active") == 1) {
                            counter_active ++;
                        }
                    });



                    if(counter_active > 1) {
                        $('#panel-city').empty();
                        $('#panel-chanel').empty();
                        $('#panel-ejecutivo').empty();
                        //if($('#panel-city').attr("show-element") == 0) {
                        //generateButtonCity(JSON.parse(city));

                        generateButtonCity(JSON.parse(campaign));

                        //----------------------------  Activando y seleccionando todo los botones de campaña -----------------------------------------------
                        $('#panel-city button').each(function(index, element ) {
                            $(this).removeClass('btn-primary').addClass('btn-success');
                            $(this).attr("active",'1');
                        });

                        generateButtonChanel(JSON.parse(campaign));

                        generateButtonEjecutivoByCity(JSON.parse(ejecutivoByCity));

                        $('#panel-city').attr("show-element",'1');
                        $('#filter').removeAttr('disabled')

                        // }
                    } else if (counter_active < 2) {
                        $('#panel-city').empty();
                        $('#panel-chanel').empty();
                        $('#panel-client').empty();
                        $('#panel-ejecutivo').empty();
                        $('#panel-city').attr("show-element",'0');
                        $('#panel-chanel').attr("show-element",'0');
                        $('#panel-client').attr("show-element",'0');
                        $('#panel-ejecutivo').attr("show-element",'0');
                        $('#filter').attr('disabled','true')
                        //
                    }
                    counter_active=0;

                    //--------------------------------------------------------------FIN ---------------------------------------------------------




                    $('#panel-city').attr("show-element",'1');
                    //$('#filter').removeAttr('disabled')
                    // }
                   // generateButtonCityAll(JSON.parse(campaign));
                } else if (counter_active < 1) {
                    $('#panel-campaign').empty();
                    $('#panel-city').empty();
                    $('#panel-chanel').empty();
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    $('#panel-campaign').attr("show-element",'0');
                    $('#panel-city').attr("show-element",'0');
                    $('#panel-chanel').attr("show-element",'0');
                    $('#panel-client').attr("show-element",'0');
                    $('#panel-ejecutivo').attr("show-element",'0');
                    $('#filter').attr('disabled','true')
                    //
                }

                counter_active=0;

//                -----------------------------------------  Ocultando botones ----------------------------------------

                $('#panel-products button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 0) {
                       // $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).hide();

                    }

                });


            });

//-------------------Generando botones por campaña--------------------------------
            //generateButtonCampaign(JSON.parse(campaign))
            function generateButtonCampaign(data) {
                $.each(data.campaigne, function(i, item){
                    // console.log(item.fullname)
                    strButton ='<button type="button" active="0" customer_id= "'+ item.customer_id + '" id="'+ item.id + '" class="campaign btn btn-primary btn-xs">' + item.fullname + '</button>';
                    $('#panel-campaign').append(strButton);
                });
            }

            function generateButtonCampaignByProducto(data) {
                var campaignIdArray=[];
                var campaignArray=[];
                var product_id=[];

                $('#panel-products button').each(function(index, element ) {
                    if($(this).attr("active") == 1) {
                        product_id.push($(this).attr("id"));
                    }
                });
                counterArray = product_id.length ;
                $.each(data.productos, function(i, item){
                    for (var i = 0; i < product_id.length; i ++) {
                        _id = product_id[i];
                        if(_id == item.product_id ) {
                            //$.each(item, function(i, item2){
                            // console.log(item2.fullname);
                            campaignArray.push(item.fullname)  ;
                            campaignIdArray.push(item.company_id)
                            // });
                        }
                    }
                });
                var result = elementRepeatArray(campaignArray,counterArray);
                // var result2 = elementRepeatArray(campaignIdArray,counterArray);

                var resulDiment =[];
                var newCampaign = JSON.parse(campaign);
                for (var i = 0; i < result.length; i ++) {
                    $.each(newCampaign.campaigne, function(x, item){

                        if( item.fullname.toString() == result[i]) {
                            //$.each(item, function(i, item2){
                            // console.log(item2.fullname);
                            resulDiment.push([item.id,item.fullname])  ;
                            return false;
                            // });
                        }

                    });
                }


                //-------------- ordenando elementos ------
                resulDiment.sort(function(a,b) {
                    return a[0] - b[0];
                })

                result = [] ;
                for (var i = 0; i < resulDiment.length; i ++) {
                    result.push(resulDiment[i][1])
                }

                //console.log(resulDiment);



                for (var i = 0; i < result.length; i ++) {
                    var _id;
                    $.each(data.productos, function(x, item){

                        if(result[i] == item.fullname ) {
                            //$.each(item, function(i, item2){
                            // console.log(item2.fullname);
                            _id=item.company_id;
                            // });
                        }

                    });

                    strButton ='<button type="button" active="0"  id="'+ _id + '" class="campaign btn btn-primary btn-xs">' + result[i] + '</button>';
                    $('#panel-campaign').append(strButton);
                }
            }


            $('#panel-campaign').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
                if($(this).attr("active") == 0){
                    $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');
                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');
                }
                $('#panel-campaign button').each(function(index, element ) {

                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        counter_active ++;
                    }
                });
                if(counter_active > 1) {
                    $('#panel-city').empty();
                    $('#panel-chanel').empty();
                    //if($('#panel-city').attr("show-element") == 0) {
                    //generateButtonCity(JSON.parse(city));
                    generateButtonCity(JSON.parse(campaign));
                    generateButtonChanel(JSON.parse(campaign));
                    $('#panel-city').attr("show-element",'1');
                    $('#filter').removeAttr('disabled')
                    // }
                } else if (counter_active < 2) {
                    $('#panel-city').empty();
                    $('#panel-chanel').empty();
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    $('#panel-city').attr("show-element",'0');
                    $('#panel-chanel').attr("show-element",'0');
                    $('#panel-client').attr("show-element",'0');
                    $('#panel-ejecutivo').attr("show-element",'0');
                    $('#filter').attr('disabled','true')
                    //
                }
                counter_active=0;
            });

//--------------------- Generando botones para las ciudades ---------------------------------------
            function generateButtonCity(data) {
                var cityArray=[];
                var campaigne_id=[];

                $('#panel-campaign button').each(function(index, element ) {
                    if($(this).attr("active") == 1) {
                        campaigne_id.push($(this).attr("id"));
                    }
                });
                counterArray = campaigne_id.length ;
                $.each(data.campaigne, function(i, item){
                    for (var i = 0; i < campaigne_id.length; i ++) {
                        company_id = campaigne_id[i];
                        if(company_id == item.id ) {
                            $.each(item.city, function(i, item2){
                                // console.log(item2.fullname);
                                cityArray.push(item2.fullname)  ;
                            });
                        }
                    }
                });
                //var result = elementRepeatArray(cityArray,counterArray);
               // var result = cityArray;
                var result = cityArray.filter(function(elem, index, self) {
                    return index == self.indexOf(elem);
                });

                for (var i = 0; i < result.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ result[i] + '" class="city btn btn-primary btn-xs">' + result[i] + '</button>';
                    $('#panel-city').append(strButton);
                }
                //console.log(result);
                //console.log(campaigne_id);
            }


            $('#panel-city').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
                if($(this).attr("active") == 0){
                    $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');
                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');
                }
                $('#panel-city button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        counter_active ++;
                    }
                });

                if(counter_active > 0) {
                    //if($('#panel-chanel').attr("show-element") == 0) {
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    generateButtonEjecutivoByCity(JSON.parse(ejecutivoByCity));
                    $('#panel-chanel').attr("show-element",'1');
                    // }
                } else if (counter_active < 1) {
                    //$('#panel-chanel').empty();
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    //$('#panel-chanel').attr("show-element",'0');
                    $('#panel-client').attr("show-element",'0');
                    $('#panel-ejecutivo').attr("show-element",'0');
                }

                $('#panel-chanel button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    $(this).attr("active",'0');
                    $(this).removeClass('btn-success').addClass('btn-primary');
                });

                counter_active=0;
            });


//-------------------------------------Generate button para Canal -----------------------

            function generateButtonChanel(data) {
                var cityArray=[];
                var campaigne_id=[];

                $('#panel-campaign button').each(function(index, element ) {
                    if($(this).attr("active") == 1) {
                        campaigne_id.push($(this).attr("id"));
                    }
                });
                counterArray = campaigne_id.length ;
                $.each(data.campaigne, function(i, item){
                    for (var i = 0; i < campaigne_id.length; i ++) {
                        company_id = campaigne_id[i];
                        if(company_id == item.id ) {
                            $.each(item.chanel, function(i, item2){
                                // console.log(item2.fullname);
                                cityArray.push(item2.fullname)  ;
                            });
                        }
                    }
                });
                var result = elementRepeatArray(cityArray,counterArray);

                for (var i = 0; i < result.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ result[i] + '" class="chanel btn btn-primary btn-xs">' + result[i] + '</button>';
                    $('#panel-chanel').append(strButton);
                }
            }

            $('#panel-chanel').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
                var idChanelActive = $(this).attr("id");
                if($(this).attr("active") == 0){
                    $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');
                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');
                }


                $('#panel-chanel button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("id") == idChanelActive) {
                        $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).attr("active",'1');

                    } else {

                        $(this).addClass('btn-primary').removeClass('btn-success');
                        $(this).attr("active",'0');
                    }

                });

                $('#panel-chanel button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        counter_active ++;
                    }

                });
                if(counter_active > 0) {
                    // if($('#panel-client').attr("show-element") == 0) {
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    // newcleint = JSON.parse(JSON.stringify(client))
                    generateButtonClient(JSON.parse(client));
                    generateButtonEjecutivoByCityAndChanel(JSON.parse(ejecutivoByCityChanel))
                    $('#panel-client').attr("show-element",'1');
                    // }
                } else if (counter_active < 1) {
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    $('#panel-client').attr("show-element",'0');
                    $('#panel-ejecutivo').attr("show-element",'0');
                }
                counter_active=0;
            });


//---------------- Generatte button para cliente-----------------------------------------------



            function generateButtonClient(data) {

                var clientArray=[];
                var counterClient=0;
                $.each(data.client, function(i, item){

                    $('#panel-city button').each(function(index, element ) {
                        if($(this).attr("active") == 1) {
                            if(item.city == $(this).attr("id")) {
                                $('#panel-chanel button').each(function(index, element ) {
                                    if ($(this).attr("active") == 1) {
                                        if (item.chanel == $(this).attr("id")) {
//                                            strButton ='<button type="button" active="0"  id="'+ item.client + '" class="client btn btn-primary btn-xs">' + item.client + '</button>';
//                                            $('#panel-client').append(strButton);
                                            clientArray.push(item.client);
                                        }
                                    }
                                });
                            }
                        }
                    });

                });

//                $('#panel-city button').each(function(index, element ) {
//                    if ($(this).attr("active") == 1) {
//                        counterClient ++;
//                    }
//
//                });
//                clientArrayTotal =elementRepeatArray(clientArray,counterClient);

                clientArrayTotal = clientArray.filter(function(elem, index, self) {
                    return index == self.indexOf(elem);
                });

                for (var i = 0; i < clientArrayTotal.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ clientArrayTotal[i] + '" class="ejecutivo btn btn-primary btn-xs">' + clientArrayTotal[i] + '</button>';
                    $('#panel-client').append(strButton);
                }


            }


            $('#panel-client').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
                if($(this).attr("active") == 0){
                    $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');
                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');
                }
                $('#panel-client button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        counter_active ++;
                    }
                });
                if(counter_active > 0) {

                    $('#panel-ejecutivo').empty();
                    generateButtonEjecutivoByCityAndClient(JSON.parse(ejecutivoByCityClient));
                    $('#panel-ejecutivo').attr("show-element",'1');

                } else if (counter_active < 1) {
                    $('#panel-ejecutivo').empty();
                    generateButtonEjecutivoByCity(JSON.parse(ejecutivoByCity))
                    $('#panel-ejecutivo').attr("show-element",'0');
                }
                counter_active=0;
            });

//  ---------------- Generatte button para ejecutive-----------------------------------------------


            function generateButtonEjecutivo(data) {
                var ejecutiveArray = [];
                $.each(data.ejecutivo, function(i, item){
                    //console.log(item.fullname)
                    $('#panel-client button').each(function(index, element ) {
                        if($(this).attr("active") == 1) {
                            if(item.client == $(this).attr("id")) {

                                ejecutiveArray.push(item.fullname);
                            }
                        }
                    });


                });
                // Funcion que permite  remover de un array elementos duplicados
                var ejecutiveArrayUnique = ejecutiveArray.filter(function(elem, index, self) {
                    return index == self.indexOf(elem);
                });

                for (var i = 0; i < ejecutiveArrayUnique.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ ejecutiveArrayUnique[i] + '" class="ejecutivo btn btn-primary btn-xs">' + ejecutiveArrayUnique[i] + '</button>';
                    $('#panel-ejecutivo').append(strButton);
                }
//                console.log(ejecutiveArray);
//                console.log(ejecutiveArrayUnique);
            }

            function generateButtonEjecutivoByCity(data) {
                var ejecutiveArray = [];
                $.each(data.ejecutivo, function(i, item){
                    //console.log(item.fullname)
                    $('#panel-city button').each(function(index, element ) {
                        if($(this).attr("active") == 1) {
                            if(item.city == $(this).attr("id")) {

                                ejecutiveArray.push(item.ejecutivo);
                            }
                        }
                    });

                });
                // Funcion que permite  remover de un array elementos duplicados
                var ejecutiveArrayUnique = ejecutiveArray.filter(function(elem, index, self) {
                    return index == self.indexOf(elem);
                });

                for (var i = 0; i < ejecutiveArrayUnique.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ ejecutiveArrayUnique[i] + '" class="ejecutivo btn btn-primary btn-xs">' + ejecutiveArrayUnique[i] + '</button>';
                    $('#panel-ejecutivo').append(strButton);
                }
//                console.log(ejecutiveArray);
//                console.log(ejecutiveArrayUnique);

            }

            function generateButtonEjecutivoByCityAndClient(data) {
                var ejecutivoArray=[];
                var counterEjecutivo=0;
                $.each(data.ejecutivo, function(i, item){

                    $('#panel-city button').each(function(index, element ) {
                        if($(this).attr("active") == 1) {
                            if(item.city == $(this).attr("id")) {
                                $('#panel-client button').each(function(index, element ) {
                                    if ($(this).attr("active") == 1) {
                                        if (item.client == $(this).attr("id")) {
//                                            strButton ='<button type="button" active="0"  id="'+ item.client + '" class="client btn btn-primary btn-xs">' + item.client + '</button>';
//                                            $('#panel-client').append(strButton);
                                            ejecutivoArray.push(item.ejecutivo);
                                        }
                                    }
                                });
                            }
                        }
                    });

                });

                $('#panel-client button').each(function(index, element ) {
                    if ($(this).attr("active") == 1) {
                        counterEjecutivo ++;
                    }

                });
                //clientArrayTotal =elementRepeatArray(ejecutivoArray,counterEjecutivo)
                var clientArrayTotal = ejecutivoArray.filter(function(elem, index, self) {
                    return index == self.indexOf(elem);
                });

                for (var i = 0; i < clientArrayTotal.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ clientArrayTotal[i] + '" class="ejecutivo btn btn-primary btn-xs">' + clientArrayTotal[i] + '</button>';
                    $('#panel-ejecutivo').append(strButton);
                }

            }

            function generateButtonEjecutivoByCityAndChanel(data) {
                var ejecutivoArray=[];
                var counterEjecutivo=0;
                $.each(data.ejecutivo, function(i, item){

                    $('#panel-city button').each(function(index, element ) {
                        if($(this).attr("active") == 1) {
                            if(item.city == $(this).attr("id")) {
                                $('#panel-chanel button').each(function(index, element ) {
                                    if ($(this).attr("active") == 1) {
                                        if (item.chanel == $(this).attr("id")) {
//                                            strButton ='<button type="button" active="0"  id="'+ item.client + '" class="client btn btn-primary btn-xs">' + item.client + '</button>';
//                                            $('#panel-client').append(strButton);
                                            ejecutivoArray.push(item.ejecutivo);
                                        }
                                    }
                                });
                            }
                        }
                    });
                });

                $('#panel-chanel button').each(function(index, element ) {
                    if ($(this).attr("active") == 1) {
                        counterEjecutivo ++;
                    }

                });
               // clientArrayTotal =elementRepeatArray(ejecutivoArray,counterEjecutivo)
                var clientArrayTotal = ejecutivoArray.filter(function(elem, index, self) {
                    return index == self.indexOf(elem);
                });

                for (var i = 0; i < clientArrayTotal.length; i ++) {
                    strButton ='<button type="button" active="0"  id="'+ clientArrayTotal[i] + '" class="ejecutivo btn btn-primary btn-xs">' + clientArrayTotal[i] + '</button>';
                    $('#panel-ejecutivo').append(strButton);
                }

            }

            $('#panel-ejecutivo').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
                if($(this).attr("active") == 0){
                    $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');
                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');
                }
            });

            //---------------------------------------------------Clear selection-------------------------------------

            $('#clear-selection').on("click",function (e) {
                e.preventDefault();
                $('#panel-campaign').empty();
                $('#panel-city').empty();
                $('#panel-chanel').empty();
                $('#panel-client').empty();
                $('#panel-ejecutivo').empty();
                $('#panel-campaign').attr("show-element",'0');
                $('#panel-city').attr("show-element",'0');
                $('#panel-chanel').attr("show-element",'0');
                $('#panel-client').attr("show-element",'0');
                $('#panel-ejecutivo').attr("show-element",'0');

                $('#panel-products button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    $(this).attr("active",'0');
                    $(this).removeClass('btn-success').addClass('btn-primary');
                });

                //                -----------------------------------------  Mostrando botones ----------------------------------------

                $('#panel-products button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                        // $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).show();
                });
            });


            //---------------------------------------------------Active / desactive selection Campañas -------------------------------------

            $('#campaign-selection').on("click",function (e) {
                e.preventDefault();
                // $('#panel-campaign').empty();
                if($(this).attr("active") == 0){
                   // $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');

                    $('#panel-campaign button').each(function (index, element) {
                        // console.log($(this).attr("active"))
                        $(this).attr("active", '1');
                        $(this).removeClass('btn-primary').addClass('btn-success');
                    });

                    generateButtonCity(JSON.parse(campaign));

                    //----------------------------  Activando y seleccionando todo los botones de campaña -----------------------------------------------
                    $('#panel-city button').each(function(index, element ) {
                        $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).attr("active",'1');
                    });

                    generateButtonChanel(JSON.parse(campaign));

                    generateButtonEjecutivoByCity(JSON.parse(ejecutivoByCity));

                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');

                    $('#panel-city').empty();
                    $('#panel-chanel').empty();
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    $('#panel-campaign').attr("show-element", '0');
                    $('#panel-city').attr("show-element", '0');
                    $('#panel-chanel').attr("show-element", '0');
                    $('#panel-client').attr("show-element", '0');
                    $('#panel-ejecutivo').attr("show-element", '0');

                    $('#panel-campaign button').each(function (index, element) {
                        // console.log($(this).attr("active"))
                        $(this).attr("active", '0');
                        $(this).removeClass('btn-success').addClass('btn-primary');
                    });



                }


            });



            //---------------------------------------------------Active / desactive selection  City -------------------------------------

            $('#city-selection').on("click",function (e) {
                e.preventDefault();
                // $('#panel-campaign').empty();
                if($(this).attr("active") == 0){
                    // $(this).removeClass('btn-primary').addClass('btn-success');
                    $(this).attr("active",'1');

                    //----------------------------  Activando y seleccionando todo los botones de campaña -----------------------------------------------
                    $('#panel-city button').each(function(index, element ) {
                        $(this).removeClass('btn-primary').addClass('btn-success');
                        $(this).attr("active",'1');
                    });

                    //generateButtonChanel(JSON.parse(campaign));

                    generateButtonEjecutivoByCity(JSON.parse(ejecutivoByCity));

                }else if($(this).attr("active") == 1){
                    $(this).removeClass('btn-success').addClass('btn-primary');
                    $(this).attr("active",'0');

                    //$('#panel-chanel').empty();
                    $('#panel-client').empty();
                    $('#panel-ejecutivo').empty();
                    $('#panel-campaign').attr("show-element", '0');
                    $('#panel-chanel').attr("show-element", '0');
                    $('#panel-client').attr("show-element", '0');
                    $('#panel-ejecutivo').attr("show-element", '0');

                    $('#panel-city button').each(function (index, element) {
                        // console.log($(this).attr("active"))
                        $(this).attr("active", '0');
                        $(this).removeClass('btn-success').addClass('btn-primary');
                    });

                    $('#panel-chanel button').each(function (index, element) {
                        // console.log($(this).attr("active"))
                        $(this).attr("active", '0');
                        $(this).removeClass('btn-success').addClass('btn-primary');
                    });
                }
            });


//            -------------------------------- Boton Filtrar -------------------------------

            $('#filter').on('click',function (event) {
                //$('#result').append("Hola");

                var company_id=[];
                var city=[];
                var chanel=[];
                var client=[];
                var ejecutivo=[];
                var product;

                $('#panel-campaign button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        if(company_id.length == 0) {
                            company_id[0]  =  $(this).attr("id");;
                        } else {
                            company_id[0] =  $(this).attr("id") + "|" + company_id[0]
                        }

                    }
                });

                $('#panel-city button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        if(city.length == 0) {
                            city[0]  =  $(this).attr("id");;
                        } else {
                            city[0] =  $(this).attr("id") + "|" + city[0]
                        }

                    }
                });

                $('#panel-chanel button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        if(chanel.length == 0) {
                            chanel[0]  =  $(this).attr("id");;
                        } else {
                            chanel[0] =  $(this).attr("id") + "|" + chanel[0]
                        }

                    }
                });

                $('#panel-client button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        if(client.length == 0) {
                            client[0]  =  $(this).attr("id");;
                        } else {
                            client[0] =  $(this).attr("id") + "|" + client[0]
                        }

                    }
                });
                $('#panel-ejecutivo button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        if(ejecutivo.length == 0) {
                            ejecutivo[0]  =  $(this).attr("id");;
                        } else {
                            ejecutivo[0] =  $(this).attr("id") + "|" + ejecutivo[0]
                        }

                    }
                });



                // ----------------------Desactivando graficos ------------------------------------------------

                $('#panel-products button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    var product_id;
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        // $('#result').append($(this).attr("id"));
                        product_id = $(this).attr("id");
                        $('#bloque'+ product_id).show();
                        var url_base =  "{{ URL::to('/') }}" ;
                        product  =  product_id;

                        $('#chartdiv'+product).empty();
                        $('#MessegesTop'+product).empty();
                        var ejecutivo_id = ejecutivo;
                        var cadena = chanel;
                        var horizontal = client;
                        var product_id = $('#producto'+product).val();
                        var ubigeoext = city;
                        var campaignes = company_id;

                        var url = url_base + "/ajaxGetRecomendForLastCampaigne" ;
                        var params = JSON.parse('{"companies":"' + campaignes + '","canal":"' + cadena + '","ejecutivo":"' + ejecutivo_id + '","product_id":"' + product_id + '","cliente":"' + horizontal + '","ciudad":"' + ubigeoext + '"}');
                        ajaxJson(url_base,url,params,createChartLineal,"chartdiv"+product,"load"+product,"No hay datos",1,"MessegesTop"+product);

                    } else if($(this).attr("active") == 0) {
                        product_id = $(this).attr("id");
                        $('#bloque'+ product_id).hide();
                    }

                });

            })

//--------------------------------------- Colpse Button -------

            $('#producto-title').click(function(){
                $('.panel-collapse.in')
                    .collapse('hide');
            });
// ----------------------------------------- Funcion ------------------------------------------------------
            /**
             * Función que busca cantidad de elemntos intersectados elementos intersectados
             * @param arrayData Datos a evaluar (con datos repetidos)
             * @param counterElemetRepeat cantidad de elemntos que se repiten
             * @returns {Array} Returna un array de elemntos repetidos
             */
            function elementRepeatArray(arrayData,counterElemetRepeat) {
                sortedArr = [],
                    count = 1;
                sortedArr = arrayData.sort();
                arrayMax =[];
                for (var i = 0; i < sortedArr.length; i = i + count) {
                    count = 1;
                    for (var j = i + 1; j < sortedArr.length; j++) {
                        if (sortedArr[i] === sortedArr[j])
                            count++;
                    }
                    //console.log(sortedArr[i] + " = " + count);
                    if(counterElemetRepeat == count){
                        arrayMax.push(sortedArr[i]);
                    }
                }
                //console.log(arrayMax);
                return arrayMax
            }

        });


    </script>

<script>
    function newCampaigne(valor){

        if(valor.value != 0){
            var fullname = valor.options[valor.selectedIndex].text;
            var url= "{{ $urlBase }}" + valor.value ;
            var win = window.open(url, '_blank');
            win.focus();
        }
    }
</script>
<script>

    var url_base =  "{{ URL::to('/') }}" ;
    $(document).ready(function(){

        @foreach($ListProducts as $producto)
            $('{{'#bloque'.$producto->id}}').hide();
        @endforeach

    });

</script>

@endsection