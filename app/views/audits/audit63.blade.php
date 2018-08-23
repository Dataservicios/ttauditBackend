@extends('layouts/adminLayout')
@section('scripts_angular')
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.13/angular.min.js') }}
    {{ HTML::script('js/appBT.js') }}
@stop
@section('content')
<section>
    @include('audits/partials/menuLeftAudit')
    <div class="cuerpo"  ng-app="MyStoresN">
        <div class="cuerpo-content" ng-controller="SearchCtrl">
            <div class="row">
                <div class="col-md-12">
                    <div class="report-marco ">
                        <div class="contenedor-report">
                            <h4>Auditoria {{$detailAudit->fullname}}</h4>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">Cliente:</div>
                                <div   class="btn btn-default btn-valor">{{$customer->fullname}}</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                                <div   class="btn btn-default btn-si">Campaña:</div>
                                <div   class="btn btn-default btn-valor">{{$campaigne->fullname}}</div>
                            </div>

                        </div>
                    </div>

                    <div class="report-marco ">
                        <div class="contenedor-report">
                            <div class="row">
                                <div class="col-md-4">{{ Form::label('Tiutlo1', 'Ingresar Valor: ',['class' => 'control-label']) }}</div>
                                <div class="col-md-8"><input type="text" class="form-control" placeholder="Digite Nombre de PDV" ng-model="searchInput" ng-change="search()"></div>
                            </div>

                        </div>
                    </div>
                    <div class="report-marco ">
                        <div class="contenedor-report">
                            {{ Form::hidden('company_id', $campaigne->id, ['id' => 'company_id']) }}
                            {{ Form::hidden('audit_id', $detailAudit->id,['id' => 'audit_id']) }}
                            {{ Form::hidden('tipo', "0") }}
                            {{ Form::hidden('id', "0") }}
                            {{ Form::hidden('cliente', $customer->fullname) }}
                            {{ Form::hidden('store_id', '',['id' => 'store_id']) }}
                            <div class="form-group">
                                <div class="col-sm-2">
                                    {{ Form::label('codclient', 'PDV:',['class' => 'col-sm-4 control-label']) }}
                                </div>

                                <div class="col-sm-8">
                                    {{ Form::text('codclient', ' ', ['class' => 'form-control','style' => 'display:none']) }}
                                    {{ $errors->first('codclient', '<div class="alert alert-danger" role="alert">:message</div>') }}
                                </div>
                                <div class="col-sm-2 center-block" >
                                    <div class="form-group" id="buttonDetalle" ng-show="menuState.show">
                                        <label for="rubro">&emsp;</label>
                                        <button class="btn btn-default" type="submit" id="guardar" onclick="getPDVs()">Ver Detalle</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="report-marco " id="results">
                        <div class="contenedor-report">
                            <div class="list-group" ng-repeat="store in stores">
                                <p class="list-group-item-heading">
                                    <a href="#" id="@{{ store.store_id }}" ng-click="clickSimple(store.search); clickId(store.search);cambiarMenu()" ng-model="searchData"    class="list-group-item " >id: @{{ store.store_id }} |Ruta_id: @{{ store.road_id }} |Punto: @{{ store.store }} |Estudio: @{{ store.company }} |Visita: @{{ store.visit_id }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div id="load"></div>
                    <div class="report-marco" id="pdvs">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MODAL VENTANA Insert-->
<div id="myModalInsert" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="tittleModal">
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ingresar Valores {{$objStore->fullname.'('.$objStore->id.')'}}</h4>--}}
            </div>
            <div class="modal-body" id="bodyModal">
                <p id="fechaModal">{{--Fecha auditoria: {{$objRoadDetail[0]->created_at}}--}}</p>
                <div class="mensaje-option" id="mensajes"></div>
                <div id="sinoModal">
                    {{--<p>Seleccionar Respuesta</p>
                    <select name="sinoInsert{{$poll->id}}" id="sinoInsert{{$poll->id}}" class="form-control">
                        <option value="1" >Sí</option>
                        <option value="0" >No</option>
                    </select>--}}
                </div>
                <div id="productosModal"></div>
                <div id="publicidadModal"></div>
                <div id="comentarioModal">
                    {{--<p>Comentario</p>
                    <textarea rows="10" cols="20" wrap="soft" id="comentInsert{{$poll->id}}"></textarea>--}}
                </div>

                <!-- Progress bar-->
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active"  role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progress-barInsert">
                        <span class="sr-only">45% Complete</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="text-center" id="messageInsert">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCancelInsert">Cancelar</button>

                <button type="button" class="btn btn-primary" id="btnInsertRegister">Ingresar Registro</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL VENTANA Insert-->
@stop
@section('reportCSS')
    <!-- Galeria de imagenes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" />
@endsection
@section('report')
    <!--LIBRERIA fancybox PARA ZOOM PARA IMÁGENES-->
    {{ HTML::script('lib/fancybox/jquery.fancybox.js?v=2.1.5') }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6')}}
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
            $("#results").hide();
            var company_id = $('#company_id').val();
            var store_id = $('#codclient').val();
            var audit_id = $('#audit_id').val();
            //var city_select = ciudad.options[ciudad.selectedIndex].text;
            //var poll_id_select = pregunta.options[pregunta.selectedIndex].value;
            var product_id = 0;
            var publicity_id=0;
            var poll_option_id=0;
            var message = 'Problemas';
            var divLoading = 'load';
            var params = JSON.parse('{"company_id":"' + company_id + '","product_id":"' + product_id +'","publicity_id":"' + publicity_id +'","poll_option_id":"' + poll_option_id + '","audit_id":"' + audit_id+'","store_id":"' + store_id+'"}');
            //alert(city_select+" - "+poll_id_select);
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";

            $("#"+divLoading).html(loading);
            $.post(url , params,  function(data) {
                console.log (data.toString());

            })
                .done(function(data) {
                    // alert( "second success" );
                    console.log (data);
                    var contPoll=0;
                    var html="";var aleatorio;
                    $.each(data, function(o, item0){

                        var datos = item0.responses;
                        var poll = item0.polls;
                        var store = item0.store;
                        if (o==0){
                            html = "<div class=\"panel panel-default\">";
                            html = html + "<div class=\"panel-heading\">";
                            html = html + "<h3 class=\"panel-title\">" + store.id + " - " + store.fullname + "</h3>";
                            html = html + "</div>";
                            html = html + "<div class=\"panel-body\">";
                                html = html + "<div class=\"row\">";
                                html = html + "<div class=\"col-sm-4\">";
                                        html = html + "<b>DEPARTAMENTO: </b>" + store.ubigeo + "<br>";
                                        html = html + "<b>PROVINCIA: </b>" + store.region + "<br>";
                                        html = html + "<b>DISTRITO: </b>" + store.district + "<br>";
                                        html = html + "<b>DIRECCIÓN: </b>" + store.address + "<br>";
                                html = html + "</div>";
                                html = html + "</div>";
                            html = html + "</div>"; 
                            html = html + "</div>"; 
                        }
                        contPoll ++;
                        html = html + "<div class=\"row\">";
                        html = html + "<div class=\"panel panel-default\">";
                        html = html + "<div class=\"panel-heading\">";
                        html = html + "<h3 class=\"panel-title\"><span class=\"badge\">" + contPoll + "</span>"  + poll.question + "("+ poll.id + ")";
                        html = html + "<a href=\"#\"  onclick=\"insertRegister(); return false;\"  id=\"btnInsert"+ poll.id + "\">\n";
                        html = html + "<span class=\"glyphicon glyphicon-plus-sign\"></span>\n" + "</a>"+ "</h3>";
                        html = html + "</div>";
                        html = html + "</div>";
                        html = html + "</div>";
                        html = html + "<div class=\"row\">";
                        if ((datos.length)>0){
                            $.each(datos, function(i, item){
                                var ObjArrayFoto = item.arrayFoto;
                                html = html + "<div class=\"col-sm-8\">";
                                if ((ObjArrayFoto.length)>0){
                                    for (x=0;x<ObjArrayFoto.length;x++){
                                        html = html + "<div id='" + ObjArrayFoto[x].id + "'>";
                                        html = html + "<div id='Controles" + ObjArrayFoto[x].id + "'>";aleatorio = Math.random();
                                        html = html + "<a href='#' onclick='activarModal(" + ObjArrayFoto[x].id + ");' title='" + ObjArrayFoto[x].archivo + "'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></a>";
                                        html = html + "<a href='#' title='Girar Foto " + ObjArrayFoto[x].archivo + " -90 grados' onclick=\"girarFoto('" + ObjArrayFoto[x].archivo + "',1,'Impreso" + ObjArrayFoto[x].id + "','http://ttaudit.test/media/fotos/','" + aleatorio + "','-90'); return false;\" class='btn btn-default' role='button'>-90</a>";
                                        html = html + "<a href='#' title='Girar Foto " + ObjArrayFoto[x].archivo + " -180 grados' onclick=\"girarFoto('" + ObjArrayFoto[x].archivo + "',1,'Impreso" + ObjArrayFoto[x].id + "','http://ttaudit.test/media/fotos/','" + aleatorio + "','-180'); return false;\" class='btn btn-default' role='button'>-180</a>";
                                        html = html + "<a href='#' title='Girar Foto " + ObjArrayFoto[x].archivo + " 90 grados' onclick=\"girarFoto('" + ObjArrayFoto[x].archivo + "',1,'Impreso" + ObjArrayFoto[x].id + "','http://ttaudit.test/media/fotos/','" + aleatorio + "','90'); return false;\" class='btn btn-default' role='button'>90</a>";
                                        html = html + "<a href='#' title='Girar Foto " + ObjArrayFoto[x].archivo + " 180 grados' onclick=\"girarFoto('" + ObjArrayFoto[x].archivo + "',1,'Impreso" + ObjArrayFoto[x].id + "','http://ttaudit.test/media/fotos/','" + aleatorio + "','180'); return false;\" class='btn btn-default' role='button'>180</a>";
                                        html = html + "</div>";
                                        html = html + "<div id='Impreso" + ObjArrayFoto[x].id + "'>";
                                        html = html + "<a href='" + ObjArrayFoto[x].urlFoto + "' class='zoom1 btn btn-default' data-fancybox-group=\"button\"><img src='" + ObjArrayFoto[x].urlFoto + "' width=\"200px\" class=\"img-thumbnail\"> </a>";
                                        html = html + "</div>";
                                        html = html + "</div>";
                                    }
                                }
                                html = html + "</div>";
                                html = html + "<div class=\"col-sm-4\">";
                                var ObjResponseSiNo = item.responseSiNo;
                                if (poll.sino==1){
                                    if ((ObjResponseSiNo.length)>0){
                                        for (x=0;x<ObjResponseSiNo.length;x++){
                                            html = html + "<b>Respuesta: </b><span id=\"respuesta\">" + ObjResponseSiNo[x].texto + "</span><br>";
                                            var ObjPollDetails = ObjResponseSiNo[x].pollDetails;
                                            $.each(ObjPollDetails, function(h, item2){
                                                html = html + "<div class=\"btn-group\" role=\"group\" >";
                                                html = html + "<div class=\"btn btn-default btn-valor\">" + "Id Respuesta (" + item2.id + ") </div>";
                                                if (item2.result == 1){
                                                    html = html + "<div class=\"btn btn-default btn-si\" id=\"" + item2.id + "\">";
                                                    html = html + "Sí (" + item2.created_at + ")";
                                                    html = html + "</div>";
                                                    html = html + "<div class=\"btn btn-default btn-valor\" id=\"" + "editSiNo" + item2.id + "\">";
                                                    html = html + "<a href=\"#\" onclick=\"changeValueSiNo('" + item2.id + "',0,'" + item2.company_id + "','" + item2.id + "'); return false;\" id=\"" + "hrefSiNo" + item2.id + "\">";
                                                    html = html + "<span class=\"glyphicon glyphicon-pencil\"></span></a>";
                                                    html = html + "</div>";
                                                }else{
                                                    html = html + "<div class=\"btn btn-default btn-no\" id=\"" + item2.id + "\">";
                                                    html = html + "No (" + item2.created_at + ")";
                                                    html = html + "</div>";
                                                    html = html + "<div class=\"btn btn-default btn-valor\" id=\"" + "editSiNo" + item2.id + "\">";
                                                    html = html + "<a href=\"#\" onclick=\"changeValueSiNo('" + item2.id + "',1,'" + item2.company_id + "','" + item2.id + "'); return false;\" id=\"" + "hrefSiNo" + item2.id + "\">";
                                                    html = html + "<span class=\"glyphicon glyphicon-pencil\"></span></a>";
                                                    html = html + "</div>";
                                                }
                                                html = html + "<a class=\"btn btn-default\" href=\"" + url_base + "/admin/audits/medias/detailPhoto/" + item2.company_id  + "\" target=\"_blank\">Ver detalle</a>";
                                                html = html + "</div>";
                                            });
                                        }

                                    }
                                }

                                if (poll.options==1){
                                    html = html +"";
                                }
                                html = html + "</div>";
                            });
                        }else{
                            html = html + "<div class=\"col-sm-4\">";
                            html = html + "<div class=\"alert alert-danger\" role=\"alert\">";
                            html = html + "<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>";
                            html = html + "<span class=\"sr-only\">Error:</span>";
                            html = html + "No hay respuesta de tipo si/no";
                            html = html + "</div>";
                            html = html + "</div>";
                        }
                        html = html + "</div>";

                    });
                    $('#pdvs').append(html);
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
                    $('#'+Div).html('<a href="'+Url+namePhoto+valAlea+'" class="zoom1 btn btn-default" data-fancybox-group="button"><img src="'+Url+namePhoto+valAlea+'" width="200px" class="img-thumbnail"></a>');
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
    <script>
        function insertRegister() {
            // e.preventDefault();
            $('#myModalInsert').modal('show');
            return false;
        }
    </script>
@endsection
