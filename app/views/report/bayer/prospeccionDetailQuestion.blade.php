@extends('layouts/bayerTransferencista')
@section('content')
    <section>
        @include('report/partials/menuBayerTransferencista')
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

                    </div>
                </div>
            </div>

            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="contenedor-report">
                                <h4>{{$subTitulo}} </h4>
                            </div>
                            <div class="loading">

                            </div>
                            <div class="grafico-circle">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="loadingCliente"></div>
            {{Form::hidden('company_id', $company_id, ['id'=>'company_id'])}}
            {{Form::hidden('poll_id', $poll_id, ['id'=>'poll_id'])}}
            {{Form::hidden('visit_id', $visit_id, ['id'=>'visit_id'])}}
            {{Form::hidden('pregSino', $pregSino, ['id'=>'pregSino'])}}
            {{Form::hidden('publicity_id', $publicity_id, ['id'=>'publicity_id'])}}
            {{Form::hidden('product_id', $product_id, ['id'=>'product_id'])}}
            {{Form::hidden('type', $type, ['id'=>'type'])}}
            {{Form::hidden('cadena', $cadena, ['id'=>'cadena'])}}
            {{Form::hidden('poll_option_id', $poll_option_id, ['id'=>'poll_option_id'])}}
            <div class="row pt pb">
                <div class="col-sm-12" id="contenido">


                </div>
            </div>

        </div>
    </div>
    </section>

@stop
@section('reportCSS')
    <!-- Galeria de imagenes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" />
@endsection
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
    <!--LIBRERIA fancybox PARA ZOOM PARA IMÁGENES-->
    {{ HTML::script('lib/fancybox/jquery.fancybox.js?v=2.1.5') }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6') }}

    <script>
        $('.zoom1').fancybox(  {
            openEffect : 'elastic',
            openSpeed  : 150,

            closeEffect : 'elastic',
            closeSpeed  : 150,

            prevEffect : 'none',
            nextEffect : 'none',

            closeBtn  : true,

            helpers : {
                title : {
                    type : 'inside'
                },
                buttons : {}
            },

            afterLoad : function() {
                this.title = 'Imagen ' + (this.index + 1) + ' de ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
        });
    </script>

<script>
    var url_base =  "{{ URL::to('/') }}" ;
    var company_id = $('#company_id').val();
    var poll_id = $('#poll_id').val();
    var visit_id = $('#visit_id').val();
    var pregSino = $('#pregSino').val();
    var publicity_id = $('#publicity_id').val();
    var product_id = $('#product_id').val();
    var type = $('#type').val();
    var cadena = $('#cadena').val();
    var poll_option_id = $('#poll_option_id').val();
    var divLoading = 'loadingCliente';
    var url = url_base + "/getAjaxDetailQuestion" ;
    var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading5.gif" + "' width='40px' ></div>";
    var divContent = 'contenido';
    var contenidoDiv ='';

    var params = JSON.parse('{"type":"' + type + '","company_id":"' + company_id + '","poll_id":"' + poll_id + '","visit_id":"' + visit_id + '","pregSino":"' + pregSino + '","publicity_id":"' + publicity_id + '","product_id":"' + product_id + '","cadena":"' + cadena + '","poll_option_id":"' + poll_option_id +'"}');
    $("#"+divLoading).html(loading);

    $(document).ready(function(){

        $.post(url , params,  function(data) {
            console.log (data.toString());
        })
            .done(function(data) {
                console.log (data);

                for(i=0; i<data.details.length; i++){console.log (data.details[i]);
                    var fila = parseInt(i+1);
                    var temp = data.details[i].poll_detail;
                    var auditor = data.details[i].auditor;
                    var fotos = data.details[i].fotos;
                    var opciones = data.details[i].opciones;
                    contenidoDiv = contenidoDiv + "<div class=\"panel panel-default\">\n";
                    contenidoDiv = contenidoDiv + "                        <div class=\"panel-heading\">\n" +
                        "                            <h3 class=\"panel-title\"><span class=\"badge\">" +fila +"</span>";
                    contenidoDiv = contenidoDiv + " "+temp.fullname;

                    contenidoDiv = contenidoDiv + "</h3></div>";
                    contenidoDiv = contenidoDiv + "<div class=\"panel-body\"><div class=\"row\">\n" +
                        "                                <div class=\"col-sm-8\">";
                    contenidoDiv = contenidoDiv + "<b> CODIGO PDV:  </b>" + temp.store_id + "<br>";
                    contenidoDiv = contenidoDiv + "<b> CADENA RUC:  </b>" + temp.cadenaRuc + "<br>";
                    contenidoDiv = contenidoDiv + "<b> DEPARTAMENTO:  </b>" + temp.ubigeo + "<br>";
                    contenidoDiv = contenidoDiv + "<b> PROVINCIA:  </b>" + temp.region + "<br>";
                    contenidoDiv = contenidoDiv + "<b> DISTRITO:  </b>" + temp.district + "<br>";
                    contenidoDiv = contenidoDiv + "<b> DIRECCIÓN:  </b>" + temp.address + "<br>";
                    contenidoDiv = contenidoDiv + "<b> VISITA:  </b>" + temp.visit_id + "<br>";
                    contenidoDiv = contenidoDiv + "<b> AUDITOR:  </b>" + auditor.fullname + "<br>";
                    contenidoDiv = contenidoDiv + "<b> FECHA:  </b>" + temp.created_at + "<br>";
                    if (opciones.length>0){
                        for(j=0; j<opciones.length; j++){
                            if (j==0){
                                contenidoDiv = contenidoDiv + "<b> OPCIONES:  </b>";
                            }
                            contenidoDiv = contenidoDiv  + "<span class=\"label label-info\" id=\""+opciones[j].option_id+"\">"+opciones[j].option;
                            if (opciones[j].otro==''){

                            }else{
                                contenidoDiv = contenidoDiv  + " (" + opciones[j].otro + ") ";
                            }
                            contenidoDiv = contenidoDiv+"</span>";
                        }

                    }
                    contenidoDiv = contenidoDiv + "</div>\n" +
                        "                                <div class=\"col-sm-4\">";
                    if (fotos.length>0){
                        for(j=0; j<fotos.length; j++){
                            contenidoDiv = contenidoDiv + "<a href=\""+fotos[j].urlFoto+"\" class=\"zoom1 btn btn-default\" data-fancybox-group=\"button\"><img src=\""+ fotos[j].urlFoto +"\" width=\"90px\" class=\"img-thumbnail\"></a>"
                        }

                    }

                    contenidoDiv = contenidoDiv + "</div></div></div></div>";
                    contenidoDiv = contenidoDiv + "</div>"
                }
                $('#comboCliente').show('fast');


                $("#"+divContent).html(contenidoDiv);
            })
            .fail(function() {
                $("#"+divLoading).html("<div class='" + divLoading +"'>message</div>");

            })
            .always(function() {
                $("."+divLoading + " > img ").hide();
            });

    });



</script>

@endsection