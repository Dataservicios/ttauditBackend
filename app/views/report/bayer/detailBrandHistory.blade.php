@extends('layouts/clienteBayer')
@section('content')
<section>
    @include('report/partials/menuPrincipalBayer')
    <div class="cuerpo">
        <div class="cuerpo-content">
            <!--sección titulo y buscador-->
            <div class="row pt pb">
                <div class="col-sm-9">
                    <h4 class="report-title">{{$titulo}}</h4>

                        <div id="alertaFiltro" class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <strong>Filtrado por:</strong>


                        </div>


                    <div class="row">
                        <!--Filtros con combos-->
                    {{Form::hidden('company_id', $company_id, ['id'=>'company_id','class' => 'form-control']);}}
                        @if(count($ListCadenas)>0)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="cadena">Cadenas</label>
                                    {{ Form::hidden('cadena', "0") }}
                                    @foreach($ListCadenas as $cadena1)
                                        <div class="checkbox">
                                            <label>
                                                @if(is_array($cadena))
                                                    @if(in_array($cadena1,$cadena))
                                                        {{Form::checkbox('cadena[]', $cadena1,true, ['class' => 'checkbox1']);}} {{$cadena1}}
                                                    @else
                                                        {{Form::checkbox('cadena[]', $cadena1,null, ['class' => 'checkbox1']);}} {{$cadena1}}
                                                    @endif
                                                @else
                                                    {{Form::checkbox('cadena[]', $cadena1,null, ['class' => 'checkbox1']);}} {{$cadena1}}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @else
                            {{ Form::hidden('cadena', "0") }}
                        @endif
                        @if(count($ListHorizontales)>0)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="cadena">Horizontales</label>
                                    {{ Form::hidden('horizontal', "0") }}
                                    @foreach($ListHorizontales as $cadena2)
                                        <div class="checkbox">
                                            <label>
                                                @if(is_array($horizontal))
                                                    @if(in_array($cadena2,$horizontal))
                                                        {{Form::checkbox('horizontal[]', $cadena2,true, ['class' => 'checkbox1']);}} {{$cadena2}}
                                                    @else
                                                        {{Form::checkbox('horizontal[]', $cadena2,null, ['class' => 'checkbox1']);}} {{$cadena2}}
                                                    @endif
                                                @else
                                                    {{Form::checkbox('horizontal[]', $cadena2,null, ['class' => 'checkbox1']);}} {{$cadena2}}
                                                @endif

                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            {{ Form::hidden('horizontal', "0") }}
                        @endif

                    {{ Form::close() }}
                    <!-- Fin Filtros con combos-->
                    </div>

                </div>
                <div class="col-sm-3">
                    <img src="{{$logo}}" width="100px">
                </div>
            </div>

            @foreach($ListProducts as $producto)
                {{Form::hidden('producto'.$producto->id, $producto->id, ['id'=>'producto'.$producto->id,'class' => 'form-control']);}}
                {{Form::hidden('cadena'.$producto->id, $cadenaLink, ['id'=>'cadena'.$producto->id]);}}
                {{Form::hidden('horizontal'.$producto->id, $horizontalLink, ['id'=>'horizontal'.$producto->id]);}}
                {{Form::hidden('ejecutivo'.$producto->id, $ejecutivo_id, ['id'=>'ejecutivo'.$producto->id]);}}
                {{Form::hidden('ubigeoext'.$producto->id, $ubigeoextLink, ['id'=>'ubigeoext'.$producto->id]);}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row pt pb">
                            <div class="col-sm-12">
                                <h3>{{$producto->fullname}}</h3>
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
                                        <div id="{{'chartdiv'.$producto->id}}" style="width: 100%; height: 550px;" ></div>
                                        <div style="text-align: center"><small></small></div>
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
        {{ HTML::script('js/ajaxJsonFunction.js')}}

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
        var company_id = $('#company_id').val();



    });

</script>
    <script>

        var url_base =  "{{ URL::to('/') }}" ;
        $(document).ready(function(){

            @foreach($ListProducts as $producto)
                var cadena = $('{{'#cadena'.$producto->id}}').val();
                var horizontal = $('{{'#horizontal'.$producto->id}}').val();
                var product_id = $('{{"#producto".$producto->id}}').val();
                var ubigeoext = $('{{'#ubigeoext'.$producto->id}}').val();

                var url = url_base + "/ajaxRecomendSalesForProductAll" ;
                var params = JSON.parse('{"cadena":"' + cadena + '","product_id":"' + product_id + '","horizontal":"' + horizontal + '","ubigeoext":"' + ubigeoext + '"}');
                ajaxJson(url_base,url,params,createChartLineal,"{{'chartdiv'.$producto->id}}","{{'load'.$producto->id}}","No hay datos");
            @endforeach

        });

    </script>

@endsection