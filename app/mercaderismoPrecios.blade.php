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
                            for(i=0; i<data.length; i++){
                                $("#categoria").append("<option value='" +data1[i].category_product_id+"'> "+data1[i].fullname+"</option>")
                            }
                            $('#comboCategoria').show('fast');
                            $('#filter').show('fast');
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
        /*$("#categoria").change(function(event){
            var categoria = event.target.value;
            var company_id = $('#company_id').val();
            var divLoading = 'loadingClienteP';
            var url = url_base + "/getProductsForCategoryMerca" ;
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading5.gif" + "' width='40px' ></div>";

            var params = JSON.parse('{"category":"' + categoria + '","company_id":"' + company_id +'"}');
            $("#"+divLoading).html(loading);
            $('#comboProducto').hide('slow');
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
                })
                .fail(function() {
                    $("#"+divLoading).html("<div class='" + divLoading +"'>message</div>");

                })
                .always(function() {
                    $("."+divLoading + " > img ").hide();
                });
        });*/

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


            var company_id = $('#company_id').val();

            var url_base = "{{ URL::to('/') }}" ;
            var url = url_base + "/ajaxGetPricesFound" ;
            var divChart = 'chartdiv1' ;
            var divLoading = 'load'
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";
            var params = JSON.parse('{"company_id":"' + company_id + '","chanel":"' + chanel + '","client":"' + client + '","category_product_id":"' + category_product_id +  '"}');

            $("#"+divLoading).html(loading);
            $.post(url , params,  function(data) {
                console.log (data.toString());

            })
                .done(function(data) {
                    var chartData = JSON.parse(data.datos);
                    creaGraficoColumnasPorBloques(chartData,divChart,true,true,url_base,'','','','','S/.');
                    $('#filter').show('slow');

                })
                .fail(function() {
                    // alert( "error" );
                    $("#"+divLoading).html("<div class='" + divLoading +"'>" + message + "</div>");

                })
                .always(function() {
                    // alert( "finished" );
                    $("."+divLoading + " > img ").hide();
                });

        })
    </script>
@endsection