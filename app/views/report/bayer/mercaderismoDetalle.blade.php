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
                        {{Form::open(['route' => 'detallePopEncontradoFilter', 'method' => 'POST', 'role' => 'form'])}}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="product">TIPO POP</label>
                                {{Form::select('publicity_id', $pops, '0', ['id'=>'publicity_id','class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="product">CANAL</label>
                                {{Form::select('type', $types, '0', ['id'=>'type','class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="product">CLIENTE</label>
                                <div id="loadingCliente"></div>
                                <div id="comboCliente">{{Form::select('cliente', ['Selecciona'],'0', ['id'=>'cliente','class' => 'form-control'])}}</div>
                                {{Form::hidden('company_id', $company_id, ['id'=>'company_id'])}}
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="rubro">&emsp;</label>
                                <button class="btn btn-default" type="submit">Filtrar</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                         <!-- Fin Filtros con combos-->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="rubro">&emsp;</label>
                                {{Form::select('campaigne', $campaignes, '0', ['id'=>'campaigne','class' => 'form-control', 'onchange' => 'newCampaigne(this)'])}}

                            </div>
                        </div>

                    </div>
                    @if($leyenda<>"0")
                        <div id="alertaFiltro" class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <strong>Filtrado por:</strong>
                            {{$leyenda}}

                        </div>
                    @endif
                </div>
            </div>
            @if(count($objPublicity)>0)
                <div class="row pt pb">
                    <div class="col-sm-12">
                        <div class="report-marco ">
                            <div class="row pl">
                                <div class="col-md-12 ">
                                    <h4>{{'POP '.$objPublicity->fullname." Encontrado"}} </h4>
                                </div>
                            </div>
                            <div class="grafico-circle">
                                <div id="chartdiv1" style="width: 100%; height: 450px;" ></div>
                            </div>

                        </div>
                    </div>
                </div>
                @if ($objPublicity->id<>564)
                    <div class="row pt pb">
                        <div class="col-sm-12">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>{{'Visibilidad '.$objPublicity->fullname}} </h4>
                                    </div>
                                </div>
                                <div class="row pl">
                                    <div class="col-md-6 ">
                                        <div class="grafico-circle">
                                            <div id="chartdiv2" style="width: 100%; height: 450px;" ></div>
                                        </div>
                                        @if($linkNoVisibles<>0)
                                            <div>
                                                <a href="{{route('getDetailQuestionBayerMerc', $linkNoVisibles)}}" class="btn btn-primary btn-sm active" role="button">Ver sin Visibilidad</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="grafico-circle">
                                            <div id="chartdiv3" style="width: 100%; height: 450px;" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($objPublicity->id==565) or ($objPublicity->id==561))
                    <div class="row pt pb">
                        <div class="col-sm-12">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>{{'¿Luz Led Operativa? POP '.$objPublicity->fullname}} </h4>
                                    </div>
                                </div>
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <div class="grafico-circle">
                                            <div id="chartdiv8" style="width: 100%; height: 450px;" ></div>
                                        </div>
                                        @if($linkNoOperativo<>0)
                                            <div>
                                                <a href="{{route('getDetailQuestionBayerMerc', $linkNoOperativo)}}" class="btn btn-primary btn-sm active" role="button">Led No Operativos</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($objPublicity->id==586)
                    <div class="row pt pb">
                        <div class="col-sm-12">
                            <div class="report-marco ">
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <h4>{{'Cumple Layout 50% '.$objPublicity->fullname}} </h4>
                                    </div>
                                </div>
                                <div class="row pl">
                                    <div class="col-md-12 ">
                                        <div class="grafico-circle">
                                            <div id="chartdiv9" style="width: 100%; height: 450px;" ></div>
                                        </div>
                                        @if($linkNoLayout<>0)
                                            <div>
                                                <a href="{{route('getDetailQuestionBayerMerc', $linkNoLayout)}}" class="btn btn-primary btn-sm active" role="button">No Cumple Layout</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(($objPublicity->id<>585) and ($objPublicity->id<>586))
                        <div class="row pt pb">
                            <div class="col-sm-12">
                                <div class="report-marco ">
                                    <div class="row pl">
                                        <div class="col-md-12 ">
                                            @if($objPublicity->id==564)
                                                <h4>{{'Estado '.$objPublicity->fullname}} visita {{$num_end_visit_end}} </h4>
                                            @else
                                                <h4>{{'Estado '.$objPublicity->fullname}} </h4>
                                            @endif
                                        </div>
                                    </div>
                                    @if($objPublicity->id<>564)
                                        <div class="row pl">
                                            <div class="col-md-6 ">
                                                <div class="grafico-circle">
                                                    <div id="chartdiv4" style="width: 100%; height: 450px;" ></div>
                                                </div>
                                                @if($linkMalEstado<>0)
                                                    <div>
                                                        <a href="{{route('getDetailQuestionBayerMerc', $linkMalEstado)}}" class="btn btn-primary btn-sm active" role="button">Mal Estado</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="grafico-circle">
                                                    <div id="chartdiv5" style="width: 100%; height: 450px;" ></div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    @if($objPublicity->id==564)
                                        <div class="row pl">
                                            <div class="col-md-12 ">
                                                <div class="grafico-circle">
                                                    <div id="chartdiv4" style="width: 100%; height: 450px;" ></div>
                                                </div>
                                                @if(count($detalleEstadoVisitas)>0)
                                                    <div class="report-marco ">

                                                        <div class="row pl">
                                                            <div class="col-md-12 ">
                                                                <h4>Detalle {{'Estado '.$objPublicity->fullname}}</h4>
                                                            </div>
                                                        </div>

                                                        {{-- leyenda ---------------}}
                                                        <div class="row pl pb ">
                                                            <div class="col-md-12 legend">
                                                                @foreach($detalleEstadoVisitas as $detalle)
                                                                    <div class="legend-block">
                                                                        <h6>{{$detalle['tipo']}}</h6>
                                                                        <ul class="legend-elemet">
                                                                        @foreach($detalle['detalles'] as $detail)
                                                                            <li data-toggle="tooltip" data-placement="top" title="{{$detail['texto']}}"><span class="icon-legend" style="background-color:{{$detail['color']}}"></span> {{$detail['porcentaje'].'% ('.$detail['cantidad'].')'}}</li>
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
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="grafico-circle">
                                                    <div class="row pl">
                                                        <div class="col-md-12 ">
                                                            <h4>Detalle Mal Estado </h4>
                                                        </div>
                                                    </div>
                                                    <div id="chartdiv5" style="width: 100%; height: 450px;" ></div>
                                                </div>
                                                @if(count($detalleOpcionesEstadoVisitas)>0)
                                                    <div class="report-marco ">

                                                        <div class="row pl">
                                                            <div class="col-md-12 ">
                                                                <h4>Detalle Mal Estado</h4>
                                                            </div>
                                                        </div>

                                                        {{-- leyenda ---------------}}
                                                        <div class="row pl pb ">
                                                            <div class="col-md-12 legend">
                                                                @foreach($detalleOpcionesEstadoVisitas as $detalle)
                                                                    <div class="legend-block">
                                                                        <h6>{{$detalle['tipo']}}</h6>
                                                                        <ul class="legend-elemet">
                                                                            @foreach($detalle['detalles'] as $detail)
                                                                                <li data-toggle="tooltip" data-placement="top" title="{{$detail['texto']}}"><span class="icon-legend" style="background-color:{{$detail['color']}}"></span> {{$detail['porcentaje'].'% ('.$detail['cantidad'].')'}}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        {{-- ----------------FIN---------------}}
                                                    </div>
                                                    @if(count($linkMalEstado)>0)
                                                        @foreach($linkMalEstado as $link)
                                                            <a href="{{route('getDetailQuestionBayerMerc', $link['link'])}}" class="campaign btn btn-xs btn-success" role="button" target="_blank">Mal Estado {{$link['visita']}} </a>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @if($linkMalEstado<>0)
                                                        <div>
                                                            <a href="{{route('getDetailQuestionBayerMerc', $linkMalEstado)}}" class="btn btn-primary btn-sm active" role="button">Mal Estado</a>
                                                        </div>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($objPublicity->id<>564)
                            <div class="row pt pb">
                                <div class="col-sm-12">
                                    <div class="report-marco ">
                                        <div class="row pl">
                                            <div class="col-md-12 ">
                                                <h4>{{'¿Realizó Cambios en '.$objPublicity->fullname.'?'}} </h4>
                                            </div>
                                        </div>
                                        <div class="row pl">
                                            <div class="col-md-6 ">
                                                <div class="grafico-circle">
                                                    <div id="chartdiv6" style="width: 100%; height: 450px;" ></div>
                                                </div>
                                                @if($linkNoCambios<>0)
                                                    <div>
                                                        <a href="{{route('getDetailQuestionBayerMerc', $linkNoCambios)}}" class="btn btn-primary btn-sm active" role="button">No Realizo Cambios</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="grafico-circle">
                                                    <div id="chartdiv7" style="width: 100%; height: 450px;" ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                @endif

            @endif

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

        {{ HTML::script('js/graficos/Bayer-chart-ventas.js')}}
        {{ HTML::script('js/ajaxJsonFunction.js') }}

        <!-- // Libreria AMCHART creaGraficoColumnas(chartData2,"char3");	-->
<script>
    var url_base =  "{{ URL::to('/') }}" ;
$("#type").change(function(event){
    var type = event.target.value;
    var company_id = $('#company_id').val();
    var divLoading = 'loadingCliente';
    var url = url_base + "/getCadenaRucForType" ;
    var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading5.gif" + "' width='40px' ></div>";

    var params = JSON.parse('{"type":"' + type + '","company_id":"' + company_id +'"}');
    $("#"+divLoading).html(loading);
    $('#comboCliente').hide('slow');
    $.post(url , params,  function(data) {
        console.log (data.toString());
    })
        .done(function(data) {
            console.log (data);
            $('#cliente').empty();
            $("#cliente").append("<option value='0'> Selecciona</option>");
            for(i=0; i<data.length; i++){console.log (data[i]);
                $("#cliente").append("<option value='" +data[i].cadenaRuc+"'> "+data[i].cadenaRuc+"</option>")
            }
            $('#comboCliente').show('fast');
        })
        .fail(function() {
            $("#"+divLoading).html("<div class='" + divLoading +"'>message</div>");

        })
        .always(function() {
            $("."+divLoading + " > img ").hide();
        });
});

</script>
<script>
    @if(count($objPublicity)>0)
        /*var chartData1 = JSON.parse('');
        creaGraficoColumnasPorBloques(chartData1,"chartdiv1",true,false,url_base,0,100,0);*/

        // Grafico Encontrado
        var chartData1 = JSON.parse('{{$valPopJson}}');console.log (chartData1.length);
        if (chartData1.length>1){
            creaGraficoColumnasMercaderismo(chartData1,"chartdiv1",false,null,0,140,null,0);
        }else{
            creaGraficoColumnasMercaderismo(chartData1,"chartdiv1",false,null,0,140,null,0);
        }


        // Grafico Visible
        var chartData2 = JSON.parse('{{$valVisibleJson}}');
        if(chartData2 == undefined ||  chartData2 == null || chartData2 == ""){

        }else{
            //createGraphPie(chartData2,"chartdiv2");
            createGraphPieV2(chartData2,"chartdiv2",false,true);
        }

        //Grafico NO Visible
        //var chartData3 = JSON.parse('[{"category":"No Visible"}{"texto_si":"Titulo 1","Si":38,"cant_si":324}{"texto_no":"Titulo 2","No":62,"cant_no":528,"color":"#ffffff"}]');
        var chartData3 = JSON.parse('{{$valOpcionesJson}}');
        if(chartData3 == undefined ||  chartData3 == null || chartData3 == ""){

        }else{
            //creaGraficoColumnasStaked(chartData3,"chartdiv3",false,null,0,100);
            creaGraficoColumnasPorBloques(chartData3,"chartdiv3",true,false,url_base,0,100,0,"regular");
        }

    @if(($objPublicity->id<>585) and ($objPublicity->id<>586))
        // Grafico Estado
        @if ($objPublicity->id==564)
                var chartData4 = JSON.parse('{{$valEstadoJson}}');
            @else
                var chartData4 = JSON.parse('{{$valEstadoJson}}');
        @endif

        if(chartData4 == undefined ||  chartData4 == null || chartData4 == ""){

        }else{
            //createGraphPie(chartData4,"chartdiv4");
            //@if ($objPublicity->id==564)
            //var chartColors = JSON.parse('{{$valColorsEstadoVisitas}}');
                //creaGraficoColumnasPorBloques(chartData4,"chartdiv4",true,false,url_base,0,100,45,"none","",chartColors);
            @else
            @endif
            createGraphPieV2(chartData4,"chartdiv4",false,true);

        }

        // Grafico Mal Estado
        var chartData5 = JSON.parse('{{$valOpcionesEJson}}');
        if(chartData5 == undefined ||  chartData5 == null || chartData5 == ""){

        }else{
            //creaGraficoColumnasStaked(chartData5,"chartdiv5",false,null,0,100);
            @if ($objPublicity->id==564)
                var chartColors1 = JSON.parse('{{$valColorOpcionesEstadoVisitas}}');
                creaGraficoColumnasPorBloques(chartData5,"chartdiv5",true,false,url_base,0,100,45,"none","",chartColors1);
            @else
                creaGraficoColumnasPorBloques(chartData5,"chartdiv5",true,false,url_base,0,100,0,"regular");
            @endif

        }

        // Grafico Cambios
        var chartData6 = JSON.parse('{{$valCambiosJson}}');
        if(chartData6 == undefined ||  chartData6 == null || chartData6 == ""){

        }else{
            //createGraphPie(chartData6,"chartdiv6");
            createGraphPieV2(chartData6,"chartdiv6",false,true);
        }

        // Grafico Si Hay Cambios
        var chartData7 = JSON.parse('{{$valOpcionesCJson}}');
        if(chartData7 == undefined ||  chartData7 == null || chartData7 == ""){

        }else{
            creaGraficoColumnasPorBloques(chartData7,"chartdiv7",true,false,url_base,0,100,0,"regular");
        }


    @endif
    @if(($objPublicity->id==565) or ($objPublicity->id==561))
        // Grafico Led
        var chartData8 = JSON.parse('{{$valLedJson}}');
        if(chartData8 == undefined ||  chartData8 == null || chartData8 == ""){

        }else{
            //createGraphPie(chartData8,"chartdiv8");
            createGraphPieV2(chartData8,"chartdiv8",false,true);
        }
    @endif

    @if($objPublicity->id==586)
    // Grafico Layout
    var chartData9 = JSON.parse('{{$valLayoutJson}}');
    if(chartData9 == undefined ||  chartData9 == null || chartData9 == ""){

    }else{
        //createGraphPie(chartData9,"chartdiv9");
        createGraphPieV2(chartData9,"chartdiv9",false,true);
    }
    @endif

    @endif
</script>
    <script>
        function newCampaigne(valor){

            if(valor.value != 0){
                var fullname = valor.options[valor.selectedIndex].text;
                var url= "{{ route('detailPopEncontrado') }}" + "/" + valor.value + "/" + fullname ;
                var win = window.open(url, '_blank');
                win.focus();
            }
        }
    </script>
@endsection