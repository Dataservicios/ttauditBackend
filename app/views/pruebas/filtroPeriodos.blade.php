@extends('layouts.clienteBayer')
@section('content')
    {{-- ---------------------- COLOCAR ESTO EN TU ARCHIVO CSS PRINCIPAL  --}}
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

        #clear-selection {
            text-decoration: none;
        }

        /*-------------legenda --------------------------*/
        .legend {

            font-size: 12px;
        }

        .legend h6 {
            font-size: 12px;
            font-weight: bold;
        }
        .legend .legend-block{
            float: left;
            margin-right: 10px;
        }
        .legend  ul.legend-elemet {

            list-style: none;
            margin: 0;
            padding: 0;
            width: auto;
        }
        .legend  ul.legend-elemet li {


        }

        .legend  ul.legend-elemet li span{
            /*display: inline;*/
            /*background-color: #2B81AF;*/
            /*width: 40px;*/
            /*height: 40px;*/
        }

        span.icon-legend {

            width: 22px;
            height: 11px;
            margin: 2px 4px 0px 0;
            display: block;
            float: left;
            text-align: left;
        }
        span.icon-legend:before {
            /*content: "s";*/
        }

        .color_1 {
            background-color: #2B81AF;
        }

        .color_2 {
            background-color: #3797ce;
        }

        .color_3 {
            background-color: #31a7e6;
        }

    </style>
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
                                            <h4>Pruebaaaa</h4>
                                        </div>
                                    </div>

                                    {{-- COPIAR APARTIR DE ESTE DIV---------------}}
                                    <div class="row pl pb ">
                                        <div class="col-md-11 filter">
                                            <div class="row">
                                                <div class="col-md-12  pb">
                                                    <a id="clear-selection" href=""><span class="label label-info">Limpiar selección</span></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="panel panel-default ">
                                                        <div class="panel-body ">
                                                            {{--<h5 id="producto-title" data-toggle="collapse"  href="#panel-products">Productos <span class="caret"></span></h5>--}}
                                                            <div id="marcas">
                                                                <a id="producto-title" data-toggle="collapse"  href="#panel-products">Maracas <span class="caret"></span></a>
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
                                                            <h5>Campañas</h5>
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
                                                            <h5>Ciudad</h5>
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
                                    {{-- ----------------FIN---------------}}

                                    <div class="row pl pr">
                                        <div class="col-md-12">
                                            <h4>Resultado</h4>
                                            <div id="result">

                                            </div>
                                        </div>
                                    </div>
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
                                            <h4>Detalle</h4>
                                        </div>
                                    </div>

                                    {{-- leyenda ---------------}}
                                    <div class="row pl pb ">
                                        <div class="col-md-12 legend">
                                            <div class="legend-block">
                                                <h6>Corporeos</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (100)</li>
                                                    <li><span class="icon-legend color_2"></span>100% (100)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (100)</li>
                                                    <li><span class="icon-legend color_2"></span>100% (100)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>

                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                            <div class="legend-block">
                                                <h6>Ficticios</h6>
                                                <ul class="legend-elemet">
                                                    <li><span class="icon-legend color_1"></span>100% (50)</li>
                                                    <li><span class="icon-legend color_2"></span>50% (20)</li>
                                                    <li><span class="icon-legend color_3"></span>100% (100)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ----------------FIN---------------}}
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

    <script type="text/javascript">

        var url_base ="{{ asset('/') }}";

        var products                = '{"success":1,"productos":[{"product_id":"534","fullname":"Apronax"},{"product_id":"538","fullname":"Aspirina 100"},{"product_id":"539","fullname":"Redoxon"},{"product_id":"640","fullname":"Bepanthen"},{"product_id":"643","fullname":"Canesten"},{"product_id":"644","fullname":"Aspirina Forte"},{"product_id":"645","fullname":"Supradyn\/Berocca"}]}'
        var productsByCampaign      = '{"success":1,"productos":[{"product_id":"534","company_id":"30","fullname":"2Q JUL 16"},{"product_id":"534","company_id":"33","fullname":"1Q AGO 16"},{"product_id":"534","company_id":"35","fullname":"2Q AGO 16"},{"product_id":"534","company_id":"39","fullname":"1Q SET 16"},{"product_id":"534","company_id":"41","fullname":"2Q SET 16"},{"product_id":"534","company_id":"44","fullname":"1Q OCT 16"},{"product_id":"534","company_id":"60","fullname":"2Q FEB 17"},{"product_id":"534","company_id":"65","fullname":"1Q MAR 17"},{"product_id":"534","company_id":"70","fullname":"1Q ABR 17"},{"product_id":"534","company_id":"73","fullname":"2Q ABR 17"},{"product_id":"534","company_id":"91","fullname":"1Q AGO 17"},{"product_id":"538","company_id":"41","fullname":"2Q SET 16"},{"product_id":"538","company_id":"44","fullname":"1Q OCT 16"},{"product_id":"538","company_id":"70","fullname":"1Q ABR 17"},{"product_id":"538","company_id":"73","fullname":"2Q ABR 17"},{"product_id":"539","company_id":"30","fullname":"2Q JUL 16"},{"product_id":"539","company_id":"33","fullname":"1Q AGO 16"},{"product_id":"539","company_id":"35","fullname":"2Q AGO 16"},{"product_id":"539","company_id":"39","fullname":"1Q SET 16"},{"product_id":"539","company_id":"70","fullname":"1Q ABR 17"},{"product_id":"539","company_id":"73","fullname":"2Q ABR 17"},{"product_id":"640","company_id":"30","fullname":"2Q JUL 16"},{"product_id":"640","company_id":"33","fullname":"1Q AGO 16"},{"product_id":"640","company_id":"70","fullname":"1Q ABR 17"},{"product_id":"640","company_id":"73","fullname":"2Q ABR 17"},{"product_id":"640","company_id":"91","fullname":"1Q AGO 17"},{"product_id":"643","company_id":"41","fullname":"2Q SET 16"},{"product_id":"643","company_id":"44","fullname":"1Q OCT 16"},{"product_id":"643","company_id":"60","fullname":"2Q FEB 17"},{"product_id":"643","company_id":"65","fullname":"1Q MAR 17"},{"product_id":"643","company_id":"78","fullname":"1Q JUN 17"},{"product_id":"644","company_id":"30","fullname":"2Q JUL 16"},{"product_id":"644","company_id":"33","fullname":"1Q AGO 16"},{"product_id":"644","company_id":"35","fullname":"2Q AGO 16"},{"product_id":"644","company_id":"39","fullname":"1Q SET 16"},{"product_id":"644","company_id":"41","fullname":"2Q SET 16"},{"product_id":"644","company_id":"44","fullname":"1Q OCT 16"},{"product_id":"644","company_id":"60","fullname":"2Q FEB 17"},{"product_id":"644","company_id":"65","fullname":"1Q MAR 17"},{"product_id":"644","company_id":"78","fullname":"1Q JUN 17"},{"product_id":"645","company_id":"35","fullname":"2Q AGO 16"},{"product_id":"645","company_id":"39","fullname":"1Q SET 16"},{"product_id":"645","company_id":"60","fullname":"2Q FEB 17"},{"product_id":"645","company_id":"65","fullname":"1Q MAR 17"},{"product_id":"645","company_id":"88","fullname":"2Q JUN 17"}]}'
        var campaign                = '{"success":1,"campaigne":[{"id":"30","fullname":"2Q JUL 16","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"33","fullname":"1Q AGO 16","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"35","fullname":"2Q AGO 16","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"39","fullname":"1Q SET 16","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"41","fullname":"2Q SET 16","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"44","fullname":"1Q OCT 16","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"60","fullname":"2Q FEB 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"65","fullname":"1Q MAR 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"70","fullname":"1Q ABR 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"73","fullname":"2Q ABR 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"78","fullname":"1Q JUN 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"88","fullname":"2Q JUN 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"91","fullname":"1Q AGO 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id":"96","fullname":"2Q AGO 17","city":[{"fullname":"AREQUIPA"},{"fullname":"CUZCO"},{"fullname":"ICA"},{"fullname":"JUNIN"},{"fullname":"LA LIBERTAD"},{"fullname":"LAMBAYEQUE"},{"fullname":"LIMA"},{"fullname":"PIURA"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]}]}'
        var client                  = '{"success":1,"client":[{"city":"AREQUIPA","chanel":"Moderno","client":"INKAFARMA"},{"city":"AREQUIPA","chanel":"Moderno","client":"MIFARMA"},{"city":"AREQUIPA","chanel":"Tradicional","client":"DETALLISTA"},{"city":"CUZCO","chanel":"Moderno","client":"INKAFARMA"},{"city":"CUZCO","chanel":"Moderno","client":"MIFARMA"},{"city":"CUZCO","chanel":"Tradicional","client":"DETALLISTA"},{"city":"ICA","chanel":"Moderno","client":"INKAFARMA"},{"city":"ICA","chanel":"Moderno","client":"MIFARMA"},{"city":"ICA","chanel":"Tradicional","client":"DETALLISTA"},{"city":"JUNIN","chanel":"Moderno","client":"INKAFARMA"},{"city":"JUNIN","chanel":"Moderno","client":"MIFARMA"},{"city":"JUNIN","chanel":"Tradicional","client":"DETALLISTA"},{"city":"LA LIBERTAD","chanel":"Moderno","client":"INKAFARMA"},{"city":"LA LIBERTAD","chanel":"Moderno","client":"MIFARMA"},{"city":"LA LIBERTAD","chanel":"Moderno","client":"MINI CADENAS"},{"city":"LA LIBERTAD","chanel":"Tradicional","client":"DETALLISTA"},{"city":"LAMBAYEQUE","chanel":"Moderno","client":"INKAFARMA"},{"city":"LAMBAYEQUE","chanel":"Moderno","client":"MIFARMA"},{"city":"LAMBAYEQUE","chanel":"Tradicional","client":"DETALLISTA"},{"city":"LIMA","chanel":"Tradicional","client":"Mayoristas"},{"city":"LIMA","chanel":"Moderno","client":"B&S"},{"city":"LIMA","chanel":"Moderno","client":"INKAFARMA"},{"city":"LIMA","chanel":"Moderno","client":"MIFARMA"},{"city":"LIMA","chanel":"Moderno","client":"MINI CADENAS"},{"city":"LIMA","chanel":"Tradicional","client":"Sub Distribuidor"},{"city":"LIMA","chanel":"Tradicional","client":"Detallista"},{"city":"PIURA","chanel":"Moderno","client":"INKAFARMA"},{"city":"PIURA","chanel":"Moderno","client":"MIFARMA"},{"city":"PIURA","chanel":"Tradicional","client":"DETALLISTA"}]}';
        var ejecutivoByCity         = '{"success":1,"ejecutivo":[{"city":"AREQUIPA","ejecutivo":"Andrea Hopkins"},{"city":"AREQUIPA","ejecutivo":"Lourdes Ramirez"},{"city":"CUZCO","ejecutivo":"Gonzalo Leon "},{"city":"CUZCO","ejecutivo":"Lourdes Ramirez"},{"city":"ICA","ejecutivo":"Jaime Rojas"},{"city":"ICA","ejecutivo":"Lourdes Ramirez"},{"city":"JUNIN","ejecutivo":"Fanny Tello"},{"city":"JUNIN","ejecutivo":"Lourdes Ramirez"},{"city":"LA LIBERTAD","ejecutivo":"Karina Flores"},{"city":"LA LIBERTAD","ejecutivo":"Lourdes Ramirez"},{"city":"LA LIBERTAD","ejecutivo":"Paola Velasquez"},{"city":"LAMBAYEQUE","ejecutivo":"Carlos Varillas"},{"city":"LAMBAYEQUE","ejecutivo":"Karina Flores"},{"city":"LAMBAYEQUE","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","ejecutivo":"Jaime Rojas"},{"city":"LIMA","ejecutivo":"Karina Caballero"},{"city":"LIMA","ejecutivo":"Katty C\u00e1ceres"},{"city":"LIMA","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","ejecutivo":"Ofelia Mera"},{"city":"LIMA","ejecutivo":"Pablo Ramirez"},{"city":"LIMA","ejecutivo":"Rosa Luz Carranza"},{"city":"LIMA","ejecutivo":"Urias Vasquez"},{"city":"PIURA","ejecutivo":"Karina Flores"},{"city":"PIURA","ejecutivo":"Lourdes Ramirez"}]}';
        var ejecutivoByCityChanel   = '{"success":1,"ejecutivo":[{"city":"AREQUIPA","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"AREQUIPA","chanel":"Tradicional","ejecutivo":"Andrea Hopkins"},{"city":"CUZCO","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"CUZCO","chanel":"Tradicional","ejecutivo":"Gonzalo Leon "},{"city":"ICA","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"ICA","chanel":"Tradicional","ejecutivo":"Jaime Rojas"},{"city":"JUNIN","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"JUNIN","chanel":"Tradicional","ejecutivo":"Fanny Tello"},{"city":"LA LIBERTAD","chanel":"Moderno","ejecutivo":"Karina Flores"},{"city":"LA LIBERTAD","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"LA LIBERTAD","chanel":"Tradicional","ejecutivo":"Paola Velasquez"},{"city":"LA LIBERTAD","chanel":"Tradicional","ejecutivo":"Paola Velasquez"},{"city":"LAMBAYEQUE","chanel":"Moderno","ejecutivo":"Karina Flores"},{"city":"LAMBAYEQUE","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"LAMBAYEQUE","chanel":"Tradicional","ejecutivo":"Carlos Varillas"},{"city":"LIMA","chanel":"Moderno","ejecutivo":"Katty C\u00e1ceres"},{"city":"LIMA","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","chanel":"Moderno","ejecutivo":"Rosa Luz Carranza"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Jaime Rojas"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Karina Caballero"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Ofelia Mera"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Pablo Ramirez"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Urias Vasquez"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Jaime Rojas"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Karina Caballero"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Ofelia Mera"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Pablo Ramirez"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Urias Vasquez"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Jaime Rojas"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Karina Caballero"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Ofelia Mera"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Pablo Ramirez"},{"city":"LIMA","chanel":"Tradicional","ejecutivo":"Urias Vasquez"},{"city":"PIURA","chanel":"Moderno","ejecutivo":"Karina Flores"},{"city":"PIURA","chanel":"Moderno","ejecutivo":"Lourdes Ramirez"},{"city":"PIURA","chanel":"Tradicional","ejecutivo":"Karina Flores"}]}';
        var ejecutivoByCityClient   = '{"success":1,"ejecutivo":[{"city":"AREQUIPA","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"AREQUIPA","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"AREQUIPA","client":"MIFARMA","ejecutivo":"Andrea Hopkins"},{"city":"CUZCO","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"CUZCO","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"CUZCO","client":"MIFARMA","ejecutivo":"Gonzalo Leon "},{"city":"ICA","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"ICA","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"ICA","client":"MIFARMA","ejecutivo":"Jaime Rojas"},{"city":"JUNIN","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"JUNIN","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"JUNIN","client":"MIFARMA","ejecutivo":"Fanny Tello"},{"city":"LA LIBERTAD","client":"INKAFARMA","ejecutivo":"Karina Flores"},{"city":"LA LIBERTAD","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"LA LIBERTAD","client":"MIFARMA","ejecutivo":"Karina Flores"},{"city":"LA LIBERTAD","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"LA LIBERTAD","client":"MINI CADENAS","ejecutivo":"Karina Flores"},{"city":"LA LIBERTAD","client":"MINI CADENAS","ejecutivo":"Lourdes Ramirez"},{"city":"LA LIBERTAD","client":"MINI CADENAS","ejecutivo":"Paola Velasquez"},{"city":"LA LIBERTAD","client":"MINI CADENAS","ejecutivo":"Paola Velasquez"},{"city":"LAMBAYEQUE","client":"INKAFARMA","ejecutivo":"Karina Flores"},{"city":"LAMBAYEQUE","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"LAMBAYEQUE","client":"MIFARMA","ejecutivo":"Karina Flores"},{"city":"LAMBAYEQUE","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"LAMBAYEQUE","client":"MINI CADENAS","ejecutivo":"Karina Flores"},{"city":"LAMBAYEQUE","client":"MINI CADENAS","ejecutivo":"Lourdes Ramirez"},{"city":"LAMBAYEQUE","client":"MINI CADENAS","ejecutivo":"Carlos Varillas"},{"city":"LIMA","client":"B&S","ejecutivo":"Katty C\u00e1ceres"},{"city":"LIMA","client":"B&S","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","client":"B&S","ejecutivo":"Rosa Luz Carranza"},{"city":"LIMA","client":"INKAFARMA","ejecutivo":"Katty C\u00e1ceres"},{"city":"LIMA","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","client":"INKAFARMA","ejecutivo":"Rosa Luz Carranza"},{"city":"LIMA","client":"MIFARMA","ejecutivo":"Katty C\u00e1ceres"},{"city":"LIMA","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","client":"MIFARMA","ejecutivo":"Rosa Luz Carranza"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Katty C\u00e1ceres"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Lourdes Ramirez"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Rosa Luz Carranza"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Urias Vasquez"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Jaime Rojas"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Karina Caballero"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Ofelia Mera"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Pablo Ramirez"},{"city":"LIMA","client":"MINI CADENAS","ejecutivo":"Urias Vasquez"},{"city":"PIURA","client":"INKAFARMA","ejecutivo":"Karina Flores"},{"city":"PIURA","client":"INKAFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"PIURA","client":"MIFARMA","ejecutivo":"Karina Flores"},{"city":"PIURA","client":"MIFARMA","ejecutivo":"Lourdes Ramirez"},{"city":"PIURA","client":"MINI CADENAS","ejecutivo":"Karina Flores"},{"city":"PIURA","client":"MINI CADENAS","ejecutivo":"Lourdes Ramirez"},{"city":"PIURA","client":"MINI CADENAS","ejecutivo":"Karina Flores"}]}';

        $(document).ready(function($) {
// -------------------En esta secci{o solo coloca las cargas de las variables por poss
//           $.post(url_base + 'getCampaignesMercaderismo', function(data){
//               var campaign =  data.toString();
//            var campaign    = '{"success": 1,"campaigne":[{"id": "1","fullname":"Campaña 1","city":[{"fullname":"Lima"},{"fullname":"Trujillo"},{"fullname":"Arequipa"},{"fullname":"Tacna"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id": "2","fullname": "Campaña 2","city":[{"fullname":"Lima"},{"fullname":"Trujillo"},{"fullname":"Tacna"},{"fullname":"Chiclayo"}],"chanel":[{"fullname":"Moderno"},{"fullname":"Tradicional"}]},{"id": "3","fullname": "Campaña 3","city":[{"fullname":"Lima"},{"fullname":"Tacna"}],"chanel":[{"fullname":"Moderno"}]}]}'
//            var city        = '{"success": 1,"city":[{"id":"20","fullname":"Lima"},{"id": "21","fullname":"Arequipa"},{"id":"22","fullname":"Trujillo"}]}' ;
////
//            var client      = '{"success": 1,"client":[{"type":"Moderno","fullname":"INKAFARMA"},{"type":"Moderno","fullname":"MIFARMA"},{"type":"Moderno","fullname":"B&S"},{"type":"Tradicional","fullname":"DETALLISTA"},{"type":"Tradicional","fullname":"SUBDISTRIBUIDOR"}]}' ;
//            var ejecutivo   = '{"success": 1,"ejecutivo":[{"client":"INKAFARMA","fullname":"jaime"},{"client": "INKAFARMA","fullname":"Pedro"},{"client":"MIFARMA","fullname":"jaime"},{"client":"MIFARMA","fullname":"Luis"},{"client":"MIFARMA","fullname":"Juliio"},{"client":"MIFARMA","fullname":"Chato"},{"client":"B&S","fullname":"RUIZ"},{"client":"B&S","fullname":"jaime"}]}' ;
////
//            });

//            $.post(url, function(data){
//                campaign =  JSON.stringify(data);
//            });
            var counter_active = 0;
//-------------------Generando botones products--------------------------------
            generateButtonProducts(JSON.parse(products))


            function generateButtonProducts(data) {
                $.each(data.productos, function(i, item){
                    // console.log(item.fullname)
                    strButton ='<button type="button" active="0"  id="'+ item.product_id + '" class="product btn btn-primary btn-xs">' + item.fullname + '</button>';
                    $('#panel-products').append(strButton);
                });
            }

            $('#panel-products').on('click','button',function (e) {
                // console.log($(this).attr("id") + " --  " + $(this).attr("customer_id")) ;
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
                var result = elementRepeatArray(cityArray,counterArray);

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

                $('#panel-city button').each(function(index, element ) {
                    if ($(this).attr("active") == 1) {
                        counterClient ++;
                    }

                });
                clientArrayTotal =elementRepeatArray(clientArray,counterClient)

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
                clientArrayTotal =elementRepeatArray(ejecutivoArray,counterEjecutivo)

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
                clientArrayTotal =elementRepeatArray(ejecutivoArray,counterEjecutivo)

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
            })

//            -------------------------------- Boton Filtrar -------------------------------

            $('#filter').on('click',function (event) {

                var company_id=[];
                var city=[];
                var chanel=[];
                var client=[];
                var ejecutivo=[];

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

                $('#result').empty();
                $('#result').append(company_id.toString()   + '<br>');
                $('#result').append(city.toString()         + '<br>');
                $('#result').append(chanel.toString()       + '<br>');
                $('#result').append(client.toString()       + '<br>');
                $('#result').append(ejecutivo.toString()    + '<br>');


// ----------------------Desactivando graficos ------------------------------------------------

                $('#panel-products button').each(function(index, element ) {
                    // console.log($(this).attr("active"))
                    var product_id;
                    if($(this).attr("active") == 1) {
                        // company_id.push($(this).attr("id"));
                        // $('#result').append($(this).attr("id"));
                        product_id = $(this).attr("id");
                        $('#bloque'+ product_id).show();
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




        var items = [
            [100, 'Pedro'],
            [30, 'Luis'],
            [5, 'Jose']
        ];

        items.push([20,'Jauncho'])
        items.push([10,'Jauncho'])


        //console.log(items[2][1])
        console.log(items.length)
//        console.log(items.sort(function(a,b) {
//            return a[0] - b[0];
//        }))

    </script>

@endsection