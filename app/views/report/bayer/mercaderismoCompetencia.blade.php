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
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="col-md-12 ">
                                <h4>Cantidad Material POP por Competencia</h4>
                            </div>
                        </div>
                        @foreach($productsCompetitions as $productCompetition)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row pt pb">
                                        <div class="col-sm-12">
                                            <h3>{{$productCompetition->product->fullname}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt pb">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 pb">
                                            <div class="report-marco ">
                                                <div class="grafico-circle">
                                                    <div id="{{'chartdiv'.$productCompetition->product_id}}" style="width: 100%; height: 450px;" ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
    // Graficos competencia por producto
    @foreach($productsCompetitions as $productCompetition)
        var chartData3 = JSON.parse('{{json_encode($totalPorProducto[$productCompetition->product_id])}}');
        creaGraficoColumnasMercaderismo(chartData3,{{'chartdiv'.$productCompetition->product_id}},false,null,null,null,null,0);
    @endforeach

</script>

    <script>
        function newCampaigne(valor){

            if(valor.value != 0){
                var fullname = valor.options[valor.selectedIndex].text;
                var url= "{{ route('popCompetencia') }}" + "/" + valor.value + "/" + fullname ;
                var win = window.open(url, '_blank');
                win.focus();
            }
        }
    </script>

@endsection