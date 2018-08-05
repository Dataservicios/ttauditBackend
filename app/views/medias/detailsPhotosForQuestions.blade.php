@extends('layouts.adminLayout')
@section('content')
<section>
    @include('audits.partials.menuLeftAudit')
    <div class="cuerpo">
        <div class="cuerpo-content">
            <!--sección titulo y buscador-->

            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="report-marco ">
                        <div class="contenedor-report">
                            <h4>Fotos de Preguntas</h4>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">Cliente:</div>
                                <div   class="btn btn-default btn-valor">{{$customer->fullname}}</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">Campaña:</div>
                                <div   class="btn btn-default btn-valor">{{$campaigne->fullname}}</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">Base PDV:</div>
                                <div   class="btn btn-default btn-valor">{{$cantidadStoresForCampaigne}}</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">PDV Programados:</div>
                                <div   class="btn btn-default btn-valor">{{$cantidadStoresRouting}}</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">PDV Visitados:</div>
                                <div   class="btn btn-default btn-valor">{{$cantidadStoresAudit}}</div>
                            </div>
                        </div>
                    </div>

                    @if($city<>"0")
                        <div id="alertaFiltro" class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong>Filtrado por:</strong>
                        </div>
                    @endif
                    <div class="row">
                        <!--Filtros con combos-->
                        {{Form::hidden('company_id', $campaigne->id, ['id'=>'company_id','class' => 'form-control']);}}
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cadenaF">Ciudad</label>
                                {{Form::select('ciudades', $ciudades, '0', ['id'=>'ciudad','class' => 'form-control']);}}

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="product">Pregunta</label>
                                {{Form::select('preguntas', $preguntas, '0', ['id'=>'pregunta','class' => 'form-control']);}}
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="rubro">&emsp;</label>
                                <button class="btn btn-default" onclick="getPDVs()">Filtrar</button>
                            </div>

                        </div>

                    <!-- Fin Filtros con combos-->

                    </div>
                    <div id="load"></div>
                    <div class="report-marco" id="pdvs">

                    </div>

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
        <!--LIBRERIA fancybox PARA ZOOM PARA IMÁGENES-->
{{ HTML::script('lib/fancybox/jquery.fancybox.js?v=2.1.5'); }}
{{ HTML::script('lib/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5'); }}
{{ HTML::script('lib/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7'); }}
{{ HTML::script('lib/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6'); }}
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
    $('#alertaFiltro').on('closed.bs.alert', function () {
        // do something…
        console.log("Cerrando alerta");
    })
</script>
        <script>
            var url_base =  "{{ URL::to('/') }}" ;
            var url = url_base + "/ajaxGetPdvsForPollWithPhotos" ;
            function getPDVs(){
                $("#pdvs").empty();
                var company_id = $('#company_id').val();
                var city_select = ciudad.options[ciudad.selectedIndex].text;
                var poll_id_select = pregunta.options[pregunta.selectedIndex].value;
                var product_id = 0;
                var publicity_id=0;
                var poll_option_id=0;
                var message = 'Problemas';
                var divLoading = 'load';
                var params = JSON.parse('{"company_id":"' + company_id + '","poll_id":"' + poll_id_select + '","city":"' + city_select + '","product_id":"' + product_id +'","publicity_id":"' + publicity_id +'","poll_option_id":"' + poll_option_id + '"}');
                //alert(city_select+" - "+poll_id_select);
                var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";

                $("#"+divLoading).html(loading);
                $.post(url , params,  function(data) {
                    console.log (data.toString());

                })
                        .done(function(data) {
                            // alert( "second success" );
                            console.log (data);

                            var html;
                            var datos = data.datos;
                            var poll = data.poll;

                            $.each(datos, function(i, item){
                                var store = item.store;
                                html = "<div class=\"panel panel-default\">";
                                html = html + "<div class=\"panel-heading\">";
                                html = html + "<h3 class=\"panel-title\"><span class=\"badge\">" + i + "</span>" + store.id + " - " + store.fullname + "</h3>";
                                html = html + "</div>";
                                html = html + "<div class=\"panel-body\">";
                                html = html + "<div class=\"row\">";
                                html = html + "<div class=\"col-sm-4\">";
                                @if($customer->id==1)
                                        html = html + "<b>DIR: </b>" + store.codclient + "<br>";
                                @endif
                                html = html + "<b>DEPARTAMENTO: </b>" + store.ubigeo + "<br>";
                                html = html + "<b>PROVINCIA: </b>" + store.region + "<br>";
                                html = html + "<b>DISTRITO: </b>" + store.district + "<br>";
                                html = html + "<b>FECHA: </b>" + item.created_at + "<br>";
                                html = html + "</div>";
                                html = html + "<div class=\"col-sm-4\">";
                                var ObjResponseSiNo = item.responseSiNo;
                                if (poll.sino==1){
                                    if ((ObjResponseSiNo.pollDetails.length)>0){
                                        html = html + "<b>Respuesta: </b><span id=\"respuesta\">" + ObjResponseSiNo.texto + "</span><br>";
                                        var ObjPollDetails = item.responseSiNo.pollDetails;
                                        $.each(ObjPollDetails, function(h, item2){
                                            html = html + "<div class=\"btn-group\" role=\"group\" aria-label=\"...\">";
                                            html = html + "<div class=\"btn btn-default btn-valor\">" + "Id Respuesta (" + item2.id + ") </div>";
                                            if (item2.result == 1){
                                                html = html + "<div class=\"btn btn-default btn-si\" id=\"" + item2.id + "\">";
                                                html = html + "Sí (" + item2.created_at + ")";
                                                html = html + "</div>";
                                                html = html + "<div class=\"btn btn-default btn-valor\" id=\"" + "editSiNo" + item2.id + + "\">";
                                                html = html + "<a href=\"#\" onclick=\"changeValueSiNo('" + item2.id + "',0,'" + item2.company_id + "','" + item2.id + "'); return false;\" id=\"" + "hrefSiNo" + item2.id + "\">";
                                                html = html + "<span class=\"glyphicon glyphicon-pencil\"></span></a>";
                                                html = html + "</div>";
                                            }else{
                                                html = html + "<div class=\"btn btn-default btn-no\" id=\"" + item2.id + "\">";
                                                html = html + "No (" + item2.created_at + ")";
                                                html = html + "</div>";
                                                html = html + "<div class=\"btn btn-default btn-valor\" id=\"" + "editSiNo" + item2.id + + "\">";
                                                html = html + "<a href=\"#\" onclick=\"changeValueSiNo('" + item2.id + "',1,'" + item2.company_id + "','" + item2.id + "'); return false;\" id=\"" + "hrefSiNo" + item2.id + "\">";
                                                html = html + "<span class=\"glyphicon glyphicon-pencil\"></span></a>";
                                                html = html + "</div>";
                                            }
                                            html = html + "<a class=\"btn btn-default\" href=\"" + url_base + "/admin/audits/medias/detailPhoto/" + item2.company_id  + "\" target=\"_blank\">Ver detalle</a>";
                                            html = html + "</div>";
                                        });
                                    }
                                }else{
                                    if ((ObjResponseSiNo.pollDetails.length)>0){
                                        var ObjPollDetails = datos.responseSiNo.pollDetails;
                                        html = html + "<div class=\"btn btn-default btn-valor\">";
                                        $.each(ObjPollDetails, function(h, item2){
                                            html = html + "Reg. Poll Detail:" + item2.id ;
                                        });
                                        html = html + "</div>";
                                    }
                                }

                                var ObjResponseOptions = item.reponseOption;
                                if (poll.options==1){
                                    if ((ObjResponseOptions.pollOptionsDetails.length)>0){
                                        html = html + "<div class=\"report-marco \">";
                                        html = html + "<div class=\"row pl\">";
                                        html = html + "<div class=\"col-md-12 \">";
                                        html = html + "Opciones";
                                        var opciones = ObjResponseOptions.options;
                                        $.each(opciones, function(j, item3){
                                            html = html + "<div class=\"row\">";
                                            html = html + "<div class=\"col-md-12\">";
                                            html = html + "<div class=\"report-marco\" id=\"principal" + item3.id + "\">";
                                            html = html + "<div class=\"row pl\">";

                                            html = html + "<div class=\"col-md-6\">";
                                            html = html + "<div class=\"btn-group\" role=\"group\">";
                                            html = html + "<div class=\"btn btn-default btn-valor\" id=\"" + store.id + "_" + item3.id + "\">" + item3.options + "(" + item3.id + ")" + "</div>";
                                            html = html + "</div>";
                                            html = html + "</div>";

                                            html = html + "<div class=\"col-md-6\" id=\"operations" + item3.id + "\">";

                                            html = html + "</div>";

                                            html = html + "</div>";
                                            html = html + "</div>";
                                            html = html + "</div>";
                                            html = html + "</div>";
                                        });

                                        html = html + "</div>";
                                        html = html + "</div>";
                                        html = html + "</div>";
                                    }

                                }


                                html = html + "</div>";
                                html = html + "<div class=\"col-sm-4\">";
                                var arrayFotos = item.arrayFoto;
                                if ((arrayFotos.length)>0){
                                    $.each(arrayFotos, function(j, item1){
                                        if(item1.id==0){

                                        }else{
                                            html = html + "<div id='" + item1.id + "'>";
                                            html = html + "<div id='" + "Controles" + item1.id + "'>";
                                            html = html + "<a href='#' title='Girar Foto " + item1.archivo + " -90 grados' onclick='girarFoto(\"" + item1.archivo + "\",\"1\",\"" + "Impreso" + item1.id + "\",\"" + item1.urlFoto + "\",\"" + item1.id + "\",\"-90\"); return false;' class='btn btn-default' href='#' role='button'>";
                                            html = html + "-90";
                                            html = html + "</a>";
                                            html = html + "<a href='#' title='Girar Foto " + item1.archivo + " -180 grados' onclick='girarFoto(\"" + item1.archivo + "\",\"1\",\"" + "Impreso" + item1.id + "\",\"" + item1.urlFoto + "\",\"" + item1.id + "\",\"-180\"); return false;' class='btn btn-default' href='#' role='button'>";
                                            html = html + "-180";
                                            html = html + "</a>";
                                            html = html + "<a href='#' title='Girar Foto " + item1.archivo + " 90 grados' onclick='girarFoto(\"" + item1.archivo + "\",\"1\",\"" + "Impreso" + item1.id + "\",\"" + item1.urlFoto + "\",\"" + item1.id + "\",\"90\"); return false;' class='btn btn-default' href='#' role='button'>";
                                            html = html + "90";
                                            html = html + "</a>";
                                            html = html + "<a href='#' title='Girar Foto " + item1.archivo + " 180 grados' onclick='girarFoto(\"" + item1.archivo + "\",\"1\",\"" + "Impreso" + item1.id + "\",\"" + item1.urlFoto + "\",\"" + item1.id + "\",\"180\"); return false;' class='btn btn-default' href='#' role='button'>";
                                            html = html + "180";
                                            html = html + "</a>";
                                            html = html + "</div>";
                                            html = html + "<div id='" + "Impreso" + item1.id + "'>";
                                            html = html + "<a href=\"" + item1.urlFoto + "?dummy=" + item1.id + "\" class=\"zoom1 btn btn-default\" data-fancybox-group=\"button\"><img src=\"" + item1.urlFoto + "?dummy=" + item1.id + "\" width=\"200px\" class=\"img-thumbnail\"></a>";
                                            html = html + "</div>";
                                            html = html + "</div>";
                                        }

                                    });
                                }else{
                                    html = html + "No hay fotos";
                                }

                                html = html + "</div>";
                                html = html + "</div>";

                                $('#pdvs').append(html);
                                if (poll.options==1){

                                    $.each(ObjResponseOptions.optionSelected, function(h, item4){
                                        var optionSelected = store.id + "_" + item4.poll_option_id;
                                        $("#"+optionSelected).removeClass("btn-valor").addClass("btn-si");
                                    });
                                }
                            });

                        })
                        .fail(function() {
                            // alert( "error" );
                            $("#"+divLoading).html("<div class='" + divLoading +"'>" + message + "</div>");

                        })
                        .always(function() {
                            // alert( "finished" );
                            $("."+divLoading + " > img ").hide();
                        });
            }

        </script>
        <script>
            var url_base =  "{{ URL::to('/') }}" ;
            function girarFoto(namePhoto,Tipo,Div,Url,Val,grado) {
                $('#'+Div).hide(1000,'swing');
                var valAlea = "?dummy=" + (Val+1);
                var jqxhrGirarFoto = $.post("{{route('girarFotos')}}", { foto : namePhoto,grado:grado,  tipo : Tipo},  function(data) {
                    console.log ("success => " + data);
                })
                    .done(function() {

                    })
                    .fail(function() {
                    })
                    .always(function() {
                        $('#'+Div).html('<a href="'+Url+valAlea+'" class="zoom1 btn btn-default" data-fancybox-group="button"><img src="'+Url+valAlea+'" width="200px" class="img-thumbnail"></a>');
                        $('#'+Div).show(1000,'swing');
                    });
            }

        </script>
        <script>
            var url_base =  "{{ URL::to('/') }}" ;
            function changeValueSiNo(idPollDetail, Value, company_id,div) {
                var divLoading = div;
                var loading= "<div class='" + divLoading +"'><img src='"  +  url_base + "/img/loading5.gif" + "' width='30px' ></div>";
                if (Value == 0){
                    $("#"+idPollDetail).removeClass("btn btn-default btn-si");
                }
                if (Value == 1){
                    $("#"+idPollDetail).removeClass("btn btn-default btn-no");
                }
                $("#"+idPollDetail).addClass("btn btn-default btn-valor");
                $("#"+divLoading).html(loading);
                $("#editSiNo" + idPollDetail).hide('slow');


                var jqxhr = $.post("{{route('updateRegPollDetail')}}", { company_id : company_id, poll_detail_id : idPollDetail , result : Value },  function(data) {
                    console.log ("success => " + data);
                })
                    .done(function() {
                        // alert( "second success" );
                        //console.log ("success => " + data);
                    })
                    .fail(function() {
                        //alert( "error" );
                    })
                    .always(function() {
                        $("#hrefSiNo" + idPollDetail).removeAttr("onclick");
                        $("."+divLoading).remove();
                        $("#"+idPollDetail).removeClass("btn btn-default btn-valor");
                        if (Value == 0){
                            $("#hrefSiNo" + idPollDetail).attr("onclick", "changeValueSiNo('" + idPollDetail +"',1,'" + company_id +"','" + idPollDetail +"'); return false;");
                            $("#"+idPollDetail).addClass("btn btn-default btn-no");
                            $("#"+div).html("No()");
                        }
                        if (Value == 1){
                            $("#hrefSiNo" + idPollDetail).attr("onclick", "changeValueSiNo('" + idPollDetail +"',0,'" + company_id +"','" + idPollDetail +"'); return false;");
                            $("#"+idPollDetail).addClass("btn btn-default btn-si");
                            $("#"+div).html("Sí()");
                        }
                        $("#editSiNo" + idPollDetail).show('slow');
                    });
            }
        </script>
@endsection